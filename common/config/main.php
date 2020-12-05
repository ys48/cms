<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        // Url Manager
        'urlManager' => [
            // Disable index.php
            'showScriptName' => false,
            // Disable r= routes
            'enablePrettyUrl' => true,
            // Disable site/ from the URL
            'rules' => [
                '<id:\d+>/<alias:[A-Za-z0-9 -_.]+>' => 'articles/categories/view',
                '<cat>/<id:\d+>/<alias:[A-Za-z0-9 -_.]+>' => 'articles/items/view',
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\PhpManager'
        ]
    ],
    'modules' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\PhpManager'
        ],
        // 'user' => [
        //     'identityClass' => 'mdm\admin\models\User',
        //     'loginUrl' => ['admin/user/login'],
        // ],
        // 'user' => [
        //     'class' => 'dektrium\user\Module',
        //     // you will configure your module inside this file
        //     // or if need different configuration for frontend and backend you may
        //     // configure in needed configs
        // ],
        // Yii2 Articles
        'articles' => [
            'class' => 'cinghie\articles\Articles',
            'userClass' => 'dektrium\user\models\User',

            // Select Languages allowed
            'languages' => [
                "it-IT" => "it-IT",
                "en-GB" => "en-GB"
            ],
            // Select Default Language  
            'languageAll' => 'it-IT',

            // Select Date Format
            'dateFormat' => 'd F Y',

            // Select Editor: no-editor, ckeditor, imperavi, tinymce, markdown
            'editor' => 'ckeditor',

            // Select Image Types allowed
            'attachType' => ['jpg', 'jpeg', 'gif', 'png', 'csv', 'pdf', 'txt', 'doc', 'docs'],

            // Select Image Name: categoryname, original, casual
            'imageNameType' => 'categoryname',
            // Select Image Types allowed
            'imageType' => ['png', 'jpg', 'jpeg'],
            // Thumbnails Options
            'thumbOptions'  => [
                'small'  => ['quality' => 100, 'width' => 150, 'height' => 100],
                'medium' => ['quality' => 100, 'width' => 200, 'height' => 150],
                'large'  => ['quality' => 100, 'width' => 300, 'height' => 250],
                'extra'  => ['quality' => 100, 'width' => 400, 'height' => 350],
            ],

            // // Slugify Options
            // $slugifyOptions = [
            //     'separator' => '-',
            //     'lowercase' => true,
            //     'trim' => true,
            //     'rulesets'  => [
            //         'default'
            //     ]
            // ]
        ],

        // Module Kartik-v Grid
        'gridview' =>  [
            'class' => '\kartik\grid\Module',
        ],

        // Module Kartik-v Markdown Editor
        'markdown' => [
            'class' => 'kartik\markdown\Module',
        ],
        'admin' => [
            'class' => 'mdm\admin\Module',
        ]
    ],
    // 'as access' => [
    //     'class' => 'mdm\admin\components\AccessControl',
    //     'allowActions' => [
    //         'site/*',
    //         'admin/*',
    //     ]
    // ]
];
