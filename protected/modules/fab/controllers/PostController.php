<?php

/**
 * PostController
 *
 * @package fab
 * @author www.fabcms.com
 * @copyright 2010
 * @version $Id$
 * @access public
 */
class PostController extends FController
{
    private $_model = null;

    /**
     * ModelController::filters()
     *
     * @return
     */
    public function filters()
    {
        return array('accessControl');
    }

    /**
     * ModelController::accessRules()
     *
     * @return
     */
    public function accessRules()
    {
        return array(
            array('allow', 'actions' =>
            array('list', 'mine', 'delete', 'empty', 'exportexcel', 'view'), 'users' => array('@'),),
            array('allow', 'actions' =>
            array('submit'), 'users' => array('*'),
            ),
            array('deny', 'users' => array('*'),),
        );
    }

    /**
     * PostController::Listaction()
     *
     * @return void
     */
    public function actionList()
    {
        if (!isset($_GET['id'])) {
            throw new CHttpException(404, 'Lost id.');
        }

        //echo vdump($CacheForm['PForm']->_labels);
        //die;

//    $ClassModel = models::model()->findByPk($_GET['id']);
//    if ($ClassModel == null) 
//    { 
//      exit('no exist.');
//    }    

        $ClassFormer = new FabForm;
        if (!$ClassFormer->load($_GET['id'])) {
            throw new CHttpException(404, 'No Found form in data.');
        }
        //echo vdump($ClassFormer);

        $ClassPosts = posts::model();
        $ClassPosts->setModelId($_GET['id']);
        $posts = $ClassPosts->Bymid()->with('user')->findAll();

        $Classmodel = models::model();
        $this->render('list', array(
                'posts' => $posts,
                'fields' => $ClassFormer->model->_labels,
                'Former' => $ClassFormer,
                'model' => $Classmodel->with('user')->findByPk($_GET['id']))
        );
    }

    public function actionMine()
    {
        $posts = posts::model()->Bymine()->with('model', 'model.user')->findAll();
        $this->render('mine', array('posts' => $posts));
    }

    public function actionDelete()
    {
        $mid = $_POST['mid'];
        $id = $_POST['id'];
        $error = true;
        $findMyModel = models::model()->myforms()->findByPk($mid);

        if ($findMyModel) {
            $PostClass = new posts;
            $PostClass->deleteBypk($id, 'mid="' . $mid . '"');
            //$PostClass->refreshModelPostItems($mid);
            $error = false;
        }

        unset($findMyModel, $mid, $PostClass);
        $ajaxHtml = ($error) ? "alert('Error!');" : "void(null);";
        echo json_encode(array('n' => $_POST['n'], 'error' => $error, 'html' => $ajaxHtml));
        return;
    }

    public function actionEmpty()
    {
        $mid = $_POST['id'];
        $error = true;
        $findMyModel = models::model()->myforms()->findByPk($mid);

        if ($findMyModel) {
            $PostClass = new posts;
            $PostClass->deleteAll('mid="' . $mid . '"');
            $PostClass->refreshModelPostItems($mid);

            //$findMyModel->updateByPk($mid,'',array('items'=>0));
            $error = false;
        }

        unset($findMyModel, $mid, $PostClass);
        $ajaxHtml = ($error) ? "alert('Error!');" : "alert('OK!');gurl('" . Yii::app()->createurl('/fab/model/myforms') . "');";
        echo json_encode(array('error' => $error, 'html' => $ajaxHtml));
        return;
    }

    public function actionExportexcel()
    {
        if (!isset($_GET['id'])) {
            throw new CHttpException(404, 'Lost id.');
        }

        $ClassFormer = new FabForm;
        if (!$ClassFormer->load($_GET['id'])) {
            throw new CHttpException(404, 'No Found form in data.');
        }
        //echo vdump($ClassFormer);

        $ClassPosts = posts::model();
        $ClassPosts->setModelId($_GET['id']);
        $posts = $ClassPosts->Bymid()->with('user')->findAll();

        $model = models::model()->findByPk($_GET['id']);
        //echo Fabdate($model->created,'Y-m-d 星期* H:i');

        //echo vdump($ClassFormer->model->_labels);
        foreach ($posts as $post) {
            $_post[] = array(
                    'created' => Fabdate($post->created, 'Y-m-d 星期* H:i'),
                    'username' => (is_object($post->user)) ? CHtml::encode($post->user->username) : '匿名',
                ) + unserialize($post->pdata);
        }
        //echo vdump($_post);
        //die;

        Yii::import('application.modules.fab.libs.*');
        @require_once('ExcelWriterXML.php');

        $xml = new ExcelWriterXML('export_fabcms_' . $_GET['id'] . '.xls');


        $xml->docTitle($model->title);
        $xml->docAuthor('made by ' . Yii::app()->name);
        $xml->docCompany(Yii::app()->name);
        $xml->docManager('FabForm');

        $format = $xml->addStyle('StyleHeader');
        $format->fontBold();

        $format1 = $xml->addStyle('StyleTableTitle');
        $format1->fontColor('Blue');
        $format1->fontBold();

        $format2 = $xml->addStyle('StyleTableContent');
        $format2->fontSize('10');

        $format_html = $xml->addStyle('StyleTableContentHtml');
        $format_html->alignWraptext();


        $sheet = $xml->addSheet($model->title);

        $sheet->writeString(1, 1, $model->title, 'StyleHeader');
        $sheet->writeString(1, 2, '建立日期：' . Fabdate($model->created, 'Y-m-d 星期* H:i'), 'StyleHeader');

        $startRow = 3;
        $startLow = 1;
        $sheet->columnWidth($startLow, '150');
        $sheet->writeString($startRow, $startLow++, '递交时间', 'StyleTableTitle');
        $sheet->columnWidth($startLow, '80');
        $sheet->writeString($startRow, $startLow++, '递交人', 'StyleTableTitle');
        foreach ($ClassFormer->model->_labels as $label) {
            $sheet->columnWidth($startLow, '100');
            $sheet->writeString($startRow, $startLow++, $label, 'StyleTableTitle');
        }

        $startRow = 4;
        $startLow = 1;
        foreach ($_post as $_posts) {
            //$sheet->writeString($startRow,$startLow++,$_posts['created'],'StyleTableTitle');
            //$sheet->writeString($startRow,$startLow++,$_posts['username'],'StyleTableTitle');
            //$sheet->rowHeight($startRow,'20');
            foreach ($_posts as $typeID => $_p) {
                if (isset($ClassFormer->config['elements'][$typeID])) {
                    $DataAttr = $ClassFormer->config['elements'][$typeID];
                }
                if (isset($DataAttr) && $DataAttr['type'] === 'textarea') {
                    $sheet->writeHtml($startRow, $startLow++, $_p);
                    //$sheet->writeString($startRow,$startLow++,$_p,'StyleTableContentHtml');
                } else {
                    $sheet->writeString($startRow, $startLow++, $_p, 'StyleTableContent');
                }
            }
            $startRow++;
            $startLow = 1;
        }

        $xml->sendHeaders();
        $xml->writeData();

        //unset($findMyModel,$mid,$PostClass);
    }

    public function actionview()
    {
        $post = $this->LoadPost();

        $ClassFormer = new FabForm;
        $ClassFormer->load($post->mid);

        $Classmodel = models::model();
        //$model = $Classmodel->findByPk($post->mid);
        //var_dump($ClassFormer);
        //die;
        $this->render('view', array('post' => $post, 'Former' => $ClassFormer, 'model' => $Classmodel->with('user')->findByPk($post->mid)));
    }

    public function LoadPost($id = null)
    {
        if ($this->_model === null) {
            if (isset($_GET['id'])) {
                $condition = 'userid=' . Yii::app()->user->id;
                $this->_model = posts::model()->findByPk($_GET['id'], $condition);
            }
            if ($this->_model === null)
                throw new CHttpException(404, 'The post is not exist.');
        }
        return $this->_model;
    }

}
