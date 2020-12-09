<?php

use backend\models\Posts;
use yii\helpers\Html;
use yii\helpers\Url;

$total = Posts::find()->count();
$this->title = $category->category_name;
?>
<style>
    .col-sm-4{
        text-align: center;
        border-radius: 8px;
        border:1px grey;
        width:25%;
        margin-left: 3%;
        margin-top: 2%;
        transition: transform .5s;
    }
    .row{
        margin-left: 7.5%;
    }
    .col-sm-4:hover{
        -ms-transform: scale(1.02);
        /* IE 9 */
        -webkit-transform: scale(1.02);
        /* Safari 3-8 */
        transform: scale(1.02);
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    }
    .content {
        transition: transform .5s;
    }

    .content:hover {
        -ms-transform: scale(1.01);
        /* IE 9 */
        -webkit-transform: scale(1.01);
        /* Safari 3-8 */
        transform: scale(1.01);
    }
</style>
<h1 style='text-align:center;font-size:45px'><?= $category->category_name ?></h1>
<hr />
<?php if ($category->layout == 1) : ?>
    <?php foreach ($model as $article) { ?>
        <div class="row no-gutters content">
            <div class="col-6 col-md-4">
                <?php
                if ($article->image) {
                    $image = Html::img(Yii::getAlias('@imgUrl') . '/' . $article->image, ['alt' => $article->image, 'max-width' => 200, 'max-height' => 200]);
                } else {
                    $image = Html::img(Yii::getAlias('@imgUrl') . '/noImageAvailable.jpg');
                }
                echo Html::a($image, Url::to(['site/view', 'id' => $article->id]));
                ?>
            </div>
            <div class="col-12 col-sm-6 col-md-8">
                <?php
                $content = '<h1 style="width:100%; font-size:40px;">' . $article->title . '</h1>';
                echo Html::a($content, Url::to(['site/view', 'id' => $article->id]));
                ?>
                <h5 style="color:grey;"><i class="glyphicon glyphicon-user"></i>&nbsp;<?= $article->staff->username ?> &nbsp;&nbsp;<i class="glyphicon glyphicon-calendar"></i>&nbsp;<?= date('d M Y h:ia', strtotime($article->date)) ?></h5>
                <h4><?= $article->introduction ?></h4>
            </div>
        </div>
        <hr>
    <?php } ?>
<?php elseif ($category->layout == 2) : ?>
    <div class="container">
        <?php
        $rowCount = 0;
        foreach ($model as $article) {
            if ($rowCount % 3 == 0) { ?>
                <div class="row">
                <?php }
            $rowCount++; ?>
                <div class="col-sm-4">
                    <div> <?php
                            if ($article->image) {
                                $image = Html::img(Yii::getAlias('@imgUrl') . '/' . $article->image, ['alt' => $article->image, 'max-width' => 200, 'max-height' => 200]);
                            } else {
                                $image = Html::img(Yii::getAlias('@imgUrl') . '/noImageAvailable.jpg');
                            }
                            echo Html::a($image, Url::to(['site/view', 'id' => $article->id]));
                            ?>
                    </div>
                    <div>
                        <?php
                        $content = '<h1 style="width:100%; font-size:40px;">' . $article->title . '</h1>';
                        echo Html::a($content, Url::to(['site/view', 'id' => $article->id]));
                        ?>
                        <h5 style="color:grey;"><i class="glyphicon glyphicon-user"></i>&nbsp;<?= $article->staff->username ?> &nbsp;&nbsp;<i class="glyphicon glyphicon-calendar"></i>&nbsp;<?= date('d M Y', strtotime($article->date)) ?></h5>
                        <h4><?= $article->introduction ?></h4>
                    </div>
                </div>

                <?php if ($rowCount % 3 == 0 || $rowCount == $total) {?>
                    
                </div>
        <?php }
            } ?>
    </div>
<?php else : ?>
    <?php throw new \yii\web\HttpException(404, 'The requested Item could not be found.'); ?>
<?php endif; ?>