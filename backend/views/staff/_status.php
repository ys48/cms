<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?><?php
    if ($model == null) { ?>
<div style="color:red">You are not allowed to perform this action</div>
<?php } else { ?>
    <div class="category-form">
        <div class="row no-gutters">
            <div class="col-12 col-sm-6 col-md-8">Staff Username</div>
            <div class="col-6 col-md-4">Active</div>
            <hr />
            <?php
            $form = Activeform::begin();
            foreach ($model as $staff => $value) {
            ?>
                <div class="col-12 col-sm-6 col-md-8"><?= $value->username ?></div>
                <div class="col-6 col-md-4">
                    <?= $form->field($value, "[$staff]id")->hiddenInput(['value' => $value->id])->label(false) ?>
                    <?= $form->field($value, "[$staff]status")->checkbox(['checked' => $value->status == 10 ? true : false, 'label' => '', 'value' => 10]) ?>
                </div>
            <?php } ?>
            <div class="form-group" style="padding-left: 10px;">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

<?php } ?>