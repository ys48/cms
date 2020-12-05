<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class GoogleMapAsset extends AssetBundle
{
     public $basePath = '@webroot';
     public $baseUrl = '@web';
     public $css = [];
     public $js = [
        "https://maps.googleapis.com/maps/api/js?key=YOUR_KEY&callback=myMap"
     ];
}

?>