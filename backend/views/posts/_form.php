<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Category;
use kartik\file\FileInput;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model backend\models\Posts */
/* @var $form yii\widgets\ActiveForm */


$getCategory = Category::find()->all();
$categoryData = ArrayHelper::map($getCategory, 'id', 'category_name');
?>

<div class="posts-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'introduction')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'advance',
    ]) ?>

    <?= $form->field($model, 'file')->widget(FileInput::classname(), ['pluginOptions' => [
        //'initialPreview' => $model->updateAttach(),
        'initialPreviewAsData' => true,
        'overwriteInitial' => true,
        'showRemove' => true,
        'showUpload' => false,
    ]]) ?>
    <?php

    if ($model->image && empty($model->errors)) {
        echo '<img src="' . Yii::getAlias('@imgUrl') . '/' . $model->image . '"width="90px">&nbsp;&nbsp;&nbsp;';
        echo Html::a('Delete', ['posts/deleteimage', 'id' => $model->id], ['class' => 'btn btn-danger']);
    }

    ?>

    <?= $form->field($model, 'category_id')->dropDownList($categoryData, ['prompt' => 'Select Category']) ?>

    <?= $form->field($model, 'status')->dropDownList(['10' => 'Active', '0' => 'Inactive',]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>