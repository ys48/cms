<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use backend\models\Category;
use backend\models\Staff;
use kartik\daterange\DateRangePicker;

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

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'title',
            'introduction',
            //'date',
            [
                'attribute' => 'date',
                'value' => function ($model) {
                   return date('Y-m-d', strtotime($model->date));
                },
                'filterType' => GridView::FILTER_DATE_RANGE,
                'filterWidgetOptions' => [ 
                    'model' => $searchModel, 
                    'attribute' => 'date',
                    'convertFormat'=>true,
                    'readonly' => true,
                    'pluginOptions' => [ 
                        'locale'=>['format' => 'Y-m-d']
                    ],
                    'pluginEvents' => [
                        'apply.daterangepicker' => 'function(ev, picker) {
                            if($(this).val() == "") {
                                $(this).val(picker.startDate.format(picker.locale.format) + picker.locale.separator +
                                picker.endDate.format(picker.locale.format)).trigger("change");
                            }
                        }',
                        'show.daterangepicker' => 'function(ev, picker) {
                            picker.container.find(".ranges").off("mouseenter.daterangepicker", "li");
                            if($(this).val() == "") {
                                picker.container.find(".ranges .active").removeClass("active");
                            }
                        }',
                        'cancel.daterangepicker' => 'function(ev, picker) {
                            if($(this).val() != "") {
                                $(this).val("").trigger("change");
                            }
                        }'
                    ]
                ]            ],
            [
                'label' => 'Created By',
                'attribute' => 'author',
                'value' => 'staff.username',
                'filter' => ArrayHelper::map(Staff::find()->asArray()->orderBy("username ASC")->all(), 'id', 'username'),
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
                'label' => 'Category',
                'attribute' => 'category_id',
                'value' => 'category.category_name',
                'filter' => ArrayHelper::map(Category::find()->asArray()->orderBy("category_name ASC")->all(), 'id', 'category_name'),
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