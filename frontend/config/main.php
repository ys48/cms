<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        // 'user' => [
        //     'identityClass' => 'common\models\User',
        //     'enableAutoLogin' => true,
        //     'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        // ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'modules' => [
        'user' => [
            // following line will restrict access to admin controller from frontend application
            'as frontend' => 'dektrium\user\filters\FrontendFilter',
        ],
        'user' => [
            'class' => 'dektrium\user\Module',
            // you will configure your module inside this file
            // or if need different configuration for frontend and backend you may
            // configure in needed configs
        ],
        // Yii2 Articles
    'articles' => [
        // Select Path To Upload Category Image
        'categoryImagePath' => '@web/img/articles/categories/',
        // Select URL To Upload Category Image
        'categoryImageURL'  => '@web/img/articles/categories/',
        // Select Path To Upload Category Thumb
        'categoryThumbPath' => '@web/img/articles/categories/thumb/',
        // Select URL To Upload Category Image
        'categoryThumbURL'  => '@web/img/articles/categories/thumb/',

        // Select Path To Upload Item Image
        'itemImagePath' => '@web/img/articles/items/',
        // Select URL To Upload Item Image
        'itemImageURL'  => '@web/img/articles/items/',
        // Select Path To Upload Item Thumb
        'itemThumbPath' => '@web/img/articles/items/thumb/',
        // Select URL To Upload Item Thumb
        'itemThumbURL'  => '@web/img/articles/items/thumb/',
			
		// Show Titles in the views, 
        'showTitles' => true,
    ],
    ],
    'params' => $params,
];
