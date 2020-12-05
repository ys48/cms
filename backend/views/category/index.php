<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::button('Status', ['value' => Url::to('../category/status'), 'class' => 'btn btn-success','id'=>'modalButton']) ?>
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
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            'id',
            'category_name',
            'description',
            [
                'attribute' => 'created_by',
                'value' => 'user.username',
            ],
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
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>