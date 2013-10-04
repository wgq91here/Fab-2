<?php
if (!isset($model))
    $model = new UserLogin();
$this->pageTitle = Yii::app()->name . ' - ' . Yii::t("FabModule.fab", "Login");
?>

    <div style="height:100px;">&nbsp;</div>
    <CENTER>
        <table class="tableattr" style="width:450px;" cellspacing="0" cellpadding="2">
            <?php echo CHtml::beginForm(); ?>
            <tr>
                <td id="bottomtd" colspan="2" bgcolor="#CFDDF8"><h5><?php echo Yii::t("FabModule.fab", "Login"); ?></h5>
                </td>
            </tr>
            <?php if (Yii::app()->user->hasFlash('loginMessage')): ?>
                <tr>
                    <td id="bottomtd" colspan="2" style="text-align:left">
                        <?php echo Yii::app()->user->getFlash('loginMessage'); ?>
                    </td>
                </tr>
            <?php endif; ?>
            <tr>
                <td id="bottomtd" colspan="2" style="text-align:left">
                    <?php echo Yii::t("FabModule.fab", "Please fill out the following form with your login credentials:"); ?>
                    &nbsp;(<?php echo Yii::t("FabModule.fab", 'Fields with <span class="required">*</span> are required.'); ?>
                    )
                    <div style="padding-left:30px;"><?php echo CHtml::errorSummary($model); ?></div>
                </td>
            </tr>
            <tr>
                <th id="lefttd"><?php echo CHtml::activeLabelEx($model, 'username'); ?></th>
                <td id="righttd"><?php echo CHtml::activeTextField($model, 'username') ?></td>
            </tr>
            <tr>
                <th id="lefttd"><?php echo CHtml::activeLabelEx($model, 'password'); ?></th>
                <td id="righttd"><?php echo CHtml::activePasswordField($model, 'password') ?></td>
            </tr>
            <tr>
                <td id="bottomtd" colspan="2" style="text-align:right">
                    <?php echo CHtml::activeCheckBox($model, 'rememberMe'); ?>
                    <?php echo CHtml::activeLabelEx($model, 'rememberMe'); ?>
                    |
                    <?php echo CHtml::link(Yii::t("FabModule.fab", "Registration"), Yii::app()->User->registrationUrl); ?>
                    | <?php echo CHtml::link(Yii::t("FabModule.fab", "Lost Password?"), Yii::app()->User->recoveryUrl); ?>
                </td>
            </tr>
            <tr>
                <td id="bottomtd" colspan="2"
                    style="text-align:right"><?php echo CHtml::submitButton(Yii::t("FabModule.fab", "Login")); ?></td>
            </tr>
            <?php echo CHtml::endForm(); ?>
            <tr>
                <td colspan="2" style="text-align:right">
                    <div style="float:left;">&nbsp;<?php echo Yii::app()->controller->module->siteName; ?>
                        &nbsp;<?php echo Yii::app()->controller->module->version; ?>&nbsp;-&nbsp;2010
                    </div>
                </td>
            </tr>
        </table>
    </CENTER>

<?php
$form = new CForm(array(
    'elements' => array(
        'username' => array(
            'type' => 'text',
            'maxlength' => 32,
        ),
        'password' => array(
            'type' => 'password',
            'maxlength' => 32,
        ),
        'rememberMe' => array(
            'type' => 'checkbox',
        )
    ),

    'buttons' => array(
        'login' => array(
            'type' => 'submit',
            'label' => 'Login',
        ),
    ),
), $model);
?>

<?php $this->widget('Updateie'); ?>