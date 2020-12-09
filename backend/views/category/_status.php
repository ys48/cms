<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?><?php
    if ($model == null) { ?>
<div style="color:red">You are not allowed to perform this action</div>
<?php } else { ?>
    <div class="category-form">
        <div class="row no-gutters">
            <div class="col-sm-4">Category</div>
            <div class="col-sm-4">Active</div>
            <div class="col-sm-4">Layout</div>
            <hr />
            <?php
            $form = Activeform::begin();
            foreach ($model as $category => $value) {
            ?>
                <div class="col-sm-4"><?= $value->category_name ?></div>
                <div class="col-sm-4">
                    <?= $form->field($value, "[$category]status")->checkbox(['checked' => $value->status == 10 ? true : false, 'label' => '', 'value' => 10]) ?>
                    <?= $form->field($value, "[$category]id")->hiddenInput(['value' => $value->id])->label(false) ?>
                </div>
                <div class="col-sm-4"><?= $form->field($value, "[$category]layout")->radioList([1 => '<i class="glyphicon glyphicon-th-list"></i>', 2 => '<i class="glyphicon glyphicon-th"></i>'], ['encode' => false,])->label(false) ?></div>
            <?php } ?>
            <div class="form-group" style="padding-left: 10px;">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

<?php } ?>