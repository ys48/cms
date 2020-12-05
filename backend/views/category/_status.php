<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="category-form">
    <div class="row no-gutters">
        <div class="col-12 col-sm-6 col-md-8">Category</div>
        <div class="col-6 col-md-4">Active</div>
        <hr />
        <?php
        $form = Activeform::begin();
        foreach ($model as $category => $value) {
        ?>
            <div class="col-12 col-sm-6 col-md-8"><?= $value->category_name ?></div>
            <div class="col-6 col-md-4">
                <?= $form->field($value, "[$category]id")->hiddenInput(['value' => $value->id])->label(false) ?>
                <?= $form->field($value, "[$category]status")->checkbox(['checked' => $value->status == 10 ? true : false, 'label' => '', 'value' => 10]) ?>
            </div>
        <?php } ?>
        <div class="form-group" style="padding-left: 10px;">
            <?= Html::submitButton(Yii::t('app','Save'), ['class' => 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>