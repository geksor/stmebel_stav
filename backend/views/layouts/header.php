<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">B&B</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <?= \backend\widgets\CountNewItemWidget::widget() ?>

                <!-- User Account: style can be found in dropdown.less -->

                <li class="dropdown user user-menu">
                    <?= Html::a('Выход', ['site/logout'], ['data'=>['method'=>'post'] ,'class'=>'btn btn-primary btn-flat']) ?>
                </li>
            </ul>
        </div>
    </nav>
</header>
