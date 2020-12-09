<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>

    <div class="wrap">
        <?php
        NavBar::begin([
            'brandLabel' => Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);
        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
        } else {
            $menuItems = [
                ['label' => 'Home', 'url' => ['/site/index']],
                ['label' => 'Category', 'url' => ['/category/index']],
                ['label' => 'Posts', 'url' => ['/posts/index']],
            ];
            if (Yii::$app->user->can('admin')) {
                $menuItems[] = [
                    'label' => 'Staff', 'url' => ['/staff/index'],
                    'label' => 'Carousel', 'url' => ['/carousel/index'],
                ];
                $menuItems[] = [
                    'label' => 'Administration',
                    'items' => [
                        ['label' => 'Assignment', 'url' => ['/admin/assignment']],
                        '<li class="divider"></li>',
                        ['label' => 'Menu', 'url' => ['/admin/menu']],
                        '<li class="divider"></li>',
                        ['label' => 'Permission', 'url' => ['/admin/permission']],
                        '<li class="divider"></li>',
                        ['label' => 'Role', 'url' => ['/admin/role']],
                        '<li class="divider"></li>',
                        ['label' => 'Route', 'url' => ['/admin/route']],
                        '<li class="divider"></li>',
                        ['label' => 'Rule', 'url' => ['/admin/rule']],
                    ]
                ];
            }

            $menuItems[] = [
                'label' => Yii::$app->user->identity->username,
                'items' => [
                    ['label' => 'Profile', 'url' => ['/staff/update', 'id' => Yii::$app->user->identity->id]],
                    '<li class="divider"></li>',
                    ['label' => 'Log Out', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']],
                ],
            ];
            // $menuItems[] = '<li>'
            //     . Html::beginForm(['/admin/user/logout'], 'post')
            //     . Html::submitButton(
            //         'Logout (' . Yii::$app->user->identity->username . ')',
            //         ['class' => 'btn btn-link logout']
            //     )
            //     . Html::endForm()
            //     . '</li>';
        }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $menuItems,
        ]);
        NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>