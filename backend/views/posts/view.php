<?php

// use backend\models\Category;
// use Faker\Guesser\Name;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Posts */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>
<div class="posts-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'introduction',
            [
                'attribute'=>'description',
                'format'=>'html',
                'value' => $model->description,
            ],
            'date',
            [
                'label'=>'Author',
                'attribute'=>'author',
                'value'=>$model->user->username,
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
            ],
            [
                'attribute'=>'image',
                'value'=>function ($model){
                    if($model->image)
                        return Yii::getAlias('@imgUrl').'/'.$model->image;
                    else
                        return Yii::getAlias('@imgUrl').'/noImageAvailable.jpg';
                },
                'format'=>['image',['max-width'=>'200','max-height'=>'200']],  
            ],
            [
                'label'=>'Category',
                'attribute'=>'category_id',
                'value'=> $model->category->category_name,
            ],
        ],
    ]) ?>

</div>
