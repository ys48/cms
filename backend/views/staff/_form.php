<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Staff */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="staff-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'staff_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ic_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tel_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gender')->dropDownList(['Male' => 'Male', 'Female' => 'Female'],['prompt'=>'Select Gender']) ?>

    <?= $form->field($model, 'status')->dropDownList(['10' => 'Active', '0' => 'Inactive',]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
