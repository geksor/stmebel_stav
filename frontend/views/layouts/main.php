<?php

/* @var $this \frontend\components\View */

/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?>- Bro & Bro в Ставрополе</title>
    <?php $this->head() ?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
          integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
</head>
<body>
<?php $this->beginBody() ?>

<?= \frontend\widgets\CategoriesMenuWidget::widget() ?>

<? if (Yii::$app->request->url === Yii::$app->homeUrl) { ?>
    <div id="header" class="container-fluid">
        <div class="container mw-1200">
            <div class="row justify-content-between pt-4">

                <?= $this->render('headerNavBar') ?>

                <div class="phone p-3 col-12 col-lg-2 text-center text-lg-right">
                    <i class="fas fa-mobile-alt mr-2"></i>
                    <span class="navbar-text"><a href="tel:<?= Yii::$app->params['Contact']['phone_1'] ?>" style="color: #ffffff; text-decoration: none"><?= Yii::$app->params['Contact']['phone_1'] ?></a></span>
                </div>
            </div>
            <?= \frontend\widgets\SliderWidget::widget() ?>
        </div>
    </div>
<? } else { ?>
    <div class="container-fluid <?= $this->headerClass ?> pb-lg-5"
         style="background-size: cover; background-color: #302e39;">
        <div class="container mw-1200">
            <div class="row justify-content-between pt-4">

                <?= $this->render('headerNavBar') ?>

                <div class="phone p-lg-3 col-12 col-lg-2 text-center text-lg-right">
                    <i class="fas fa-mobile-alt mr-2"></i>
                    <span class="navbar-text"><a href="tel:89876739815" style="color: #ffffff; text-decoration: none">8(987)673 98 15</a></span>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <?=
                        Breadcrumbs::widget(
                            [
                                'options' => [
                                    'class' => 'breadcrumb pl-0',
                                ],
                                'itemTemplate' => '<li class="breadcrumb-item">{link}</li>',
                                'activeItemTemplate' => '<li class="breadcrumb-item active" aria-current="page">{link}</li>',
                                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                            ]
                        ) ?>
                    </nav>
                </div>
            </div>
            <div class="row text-center text-lg-left">
                <h1 class="col mb-5"><?= $this->title ?></h1>
            </div>
        </div>
    </div>
<? } ?>

<main style="flex: 1">
    <?= $content ?>
</main>

<div id="footer" class="container-fluid mt-5">
    <div class="container mw-1200">
        <div class="row justify-content-between py-4">
            <div class="col-12 col-lg-2 text-center mr-0 align-self-center">
                <a class="navbar-brand mr-0" href="<?= Yii::$app->homeUrl ?>">
                    <img src="/public/images/logo.png" alt="" class="img-fluid">
                </a>
            </div>

            <?= $this->render('footerMenu') ?>

            <div class="col-12 col-lg-2 text-center text-lg-left foot-href align-self-center mt-3 mt-lg-0">
                <a href="<?= Yii::$app->params['Contact']['insta'] ?>" target="_blank">
                    <i class="fab fa-instagram icons inst-icon"></i>
                </a>
                <a href="<?= Yii::$app->params['Contact']['vk'] ?>" target="_blank">
                    <i class="fab fa-vk icons vk-icon"></i>
                </a>
                <a href="<?= Yii::$app->params['Contact']['face'] ?>" target="_blank">
                    <i class="fab fa-facebook-f icons f-icon"></i>
                </a>
            </div>
            <div class="col-12 col-lg-2 align-self-center text-center mt-3 mt-lg-0">
                <p>Все права защищены (с) 2018</p>
                <p class="gray-p mb-0"><a href="http://web-elitit.ru/" target="_blank" style="color: inherit">design by ELIT-IT</a></p>
            </div>
        </div>
    </div>
</div>

<?= $this->render('modals')?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
