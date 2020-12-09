<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>
<style>

</style>
<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => '6']) ?>

    <?= $form->field($model, 'status')->dropDownList(['10' => 'Active', '0' => 'Inactive',]) ?>

    <?= $form->field($model, 'layout')->radioList([1 => '<i class="glyphicon glyphicon-th-list"></i>', 2 => '<i class="glyphicon glyphicon-th"></i>'], ['encode' => false]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>