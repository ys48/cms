<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Category */

$this->title = 'Update Category: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="category-update">

    <h1><?= Html::encode($model->category_name) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
