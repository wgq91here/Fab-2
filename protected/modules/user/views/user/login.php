<?php
if (!isset($model))
    $model = new UserLogin();

$this->pageTitle = Yii::app()->name . ' - ' . Yii::t("UserModule.user", "Login");
$this->breadcrumbs = array(
    Yii::t("UserModule.user", "Login"),
);
?>

<h1><?php echo Yii::t("UserModule.user", "Login"); ?></h1>

<?php if (Yii::app()->user->hasFlash('loginMessage')): ?>

    <div class="success">
        <?php echo Yii::app()->user->getFlash('loginMessage'); ?>
    </div>

<?php endif; ?>

<p><?php echo Yii::t("UserModule.user", "Please fill out the following form with your login credentials:"); ?></p>

<div class="form">
    <?php echo CHtml::beginForm(); ?>

    <p class="note"><?php echo Yii::t("UserModule.user", 'Fields with <span class="required">*</span> are required.'); ?></p>

    <?php echo CHtml::errorSummary($model); ?>

    <div class="row">
        <?php echo CHtml::activeLabelEx($model, 'username'); ?>
        <?php echo CHtml::activeTextField($model, 'username') ?>
    </div>

    <div class="row">
        <?php echo CHtml::activeLabelEx($model, 'password'); ?>
        <?php echo CHtml::activePasswordField($model, 'password') ?>
    </div>

    <div class="row">
        <p class="hint">
            <?php echo CHtml::link(Yii::t("UserModule.user", "Registration"), Yii::app()->User->registrationUrl); ?>
            | <?php echo CHtml::link(Yii::t("UserModule.user", "Lost Password?"), Yii::app()->User->recoveryUrl); ?>
        </p>
    </div>

    <div class="row rememberMe">
        <?php echo CHtml::activeCheckBox($model, 'rememberMe'); ?>
        <?php echo CHtml::activeLabelEx($model, 'rememberMe'); ?>
    </div>

    <div class="row submit">
        <?php echo CHtml::submitButton(Yii::t("UserModule.user", "Login")); ?>
    </div>

    <?php echo CHtml::endForm(); ?>
</div><!-- form -->


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
