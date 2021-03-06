<?php
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = $model->title;
?>
<div style='text-align:center'>
    <div><h1 style="font-size:32pt"><?php echo $model->title?></h1></div>
    <div><h5 style="color:grey;"><i class="glyphicon glyphicon-user"></i>&nbsp;<?= $model->staff->username ?> &nbsp;&nbsp;<i class="glyphicon glyphicon-calendar"></i>&nbsp;<?= date('d M Y h:ia', strtotime($model->date)) ?></h5></div>
    <div>
        <?php
        if($model->image) {
            $image = Html::img(Yii::getAlias('@imgUrl').'/'.$model->image,['alt'=>$model->image,'max-width'=>200,'max-height'=>200]);
        }else{
            $image = Html::img(Yii::getAlias('@imgUrl').'/noImageAvailable.jpg');
        }
        echo Html::a($image ,Url::to(['site/view','id'=>$model->id]));
        ?>
    </div>
    <hr/>
</div>
<div>
    <?php echo $model->description?>
</div>