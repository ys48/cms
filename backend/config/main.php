<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    // 'modules' => [],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'backend\models\Staff',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
            // 'loginUrl'=>'site/login',
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        // 'user' => [
        //     // following line will restrict access to profile, recovery, registration and settings controllers from backend
        //     'as backend' => 'dektrium\user\filters\BackendFilter',
        // ],
        // Yii2 Articles
        'articles' => [
            // Select Path To Upload Category Image
            'categoryImagePath' => '@frontend/web/img/articles/categories/',
            // Select URL To Upload Category Image
            'categoryImageURL'  => '/frontend/web/img/articles/categories/',
            // Select Path To Upload Category Thumb
            'categoryThumbPath' => '@frontend/web/img/articles/categories/thumb/',
            // Select URL To Upload Category Image
            'categoryThumbURL'  => '/frontend/web/img/articles/categories/thumb/',

            // Select Path To Upload Item Image
            'itemImagePath' => '@frontend/web/img/articles/items/',
            // Select URL To Upload Item Image
            'itemImageURL'  => '/frontend/web/img/articles/items/',
            // Select Path To Upload Item Thumb
            'itemThumbPath' => '@frontend/web/img/articles/items/thumb/',
            // Select URL To Upload Item Thumb
            'itemThumbURL'  => '/frontend/web/img/articles/items/thumb/',

            // Select Path To Upload Attachments
            'attachPath' => '@frontend/web/attachments/',
            // Select URL To Upload Attachment
            'attachURL' => '/yii2gogocms/frontend/web/attachments/',

            // Show Titles in the views,
            'showTitles' => false,
        ],

    ],
    'params' => $params,
];
