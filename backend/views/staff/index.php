<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\StaffSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Staff');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="staff-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Staff'), ['signup'], ['class' => 'btn btn-success']) ?>
        <?= Html::button('Status', ['value' => Url::to('../staff/status'), 'class' => 'btn btn-success','id'=>'modalButton']) ?>
    </p>
    <?php
    Modal::begin([
        'header' => '<h4>Status<h4>',
        'id' => 'modal',
        'size' => 'modal-lg',
    ]);
    echo "<div id='modalContent'></div>";
    Modal::end();
    ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //  'id',
            'staff_id',
            'username',
            //'fullname',
            //'ic_no',
            //'password',
            'email:email',
            //'tel_no',
            //'gender',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    if ($model->status == 10) {
                        return 'Active';
                    } else {
                        return 'Inactive';
                    }
                },
                'filter' => array('10' => 'Active', '0' => 'Inactive'),
            ],
            //'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
