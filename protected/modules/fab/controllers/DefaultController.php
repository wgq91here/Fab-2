<?php
class DefaultController extends FController
{
    public function actionIndex()
    {
        if (!$this->isInstalled()) {
            $this->webMessage('Fabcms hasn\'t install. Please Install it.', $this->createUrl('install/'), 3000);
            return;
        }
        $this->webMessage('Goto fabcms manage . . .', $this->createUrl('admin/'), 3000);
    }

    public function isInstalled()
    {
        return true;
    }


}