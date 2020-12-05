<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PostsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Posts', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'title',
            'introduction',
            'date',
            [
                'label'=>'Created By',
                'attribute'=>'author',
                'value'=>'user.username',
            ],

            //'image:image',
            // [
            //     'label'=>'image',
            //     'attribute'=>'image',
            //     'format'=>'html',
            //     'value'=>function ($model){
            //         return yii\bootstrap\Html::img($model->image,['width'=>'150','height'=>'150']);
            //     }
            // ],
            // [
            //     'attribute'=>'image',
            //     'value'=>Yii::getAlias('@imgUrl').'/'.'',
            //     'format'=>['image',['width'=>'120','height'=>'120']],  
            // ],
            [
                'label'=>'Category',
                'attribute'=>'category_id',
                'value'=>'category.category_name',
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
