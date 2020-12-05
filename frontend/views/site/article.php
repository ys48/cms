<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<?php foreach($model as $article){?>
<div class="row no-gutters content">
    <div class="col-6 col-md-4">
        <?php 
            if($article->image) {
                $image = Html::img(Yii::getAlias('@imgUrl').'/'.$article->image,['alt'=>$article->image,'max-width'=>200,'max-height'=>200]);
            }else{
                $image = Html::img(Yii::getAlias('@imgUrl').'/noImageAvailable.jpg');
            }
            echo Html::a($image ,Url::to(['site/view','id'=>$article->id]));    
        ?>
    </div>
    <div class="col-12 col-sm-6 col-md-8" >
        <?php 
            $content = '<h1 style="width:100%; font-size:45px;">'.$article->title.'</h1>'; 
            echo Html::a($content ,Url::to(['site/view','id'=>$article->id]));
        ?>
        <h5 style="color:grey;"><?=$article->user->username .'&nbsp;  |  &nbsp;'.date('d M Y h:ia', strtotime($article->date))?></h5>
        <h4><?=$article->introduction?></h4>
    </div>
</div>
<hr>
<?php }?>