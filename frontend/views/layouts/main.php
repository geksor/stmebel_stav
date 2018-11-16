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
    <title><?= Html::encode($this->title) ?> - Bro & Bro в Ставрополе</title>
    <?php $this->head() ?>
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#0a0712">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#0a0712">
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

<button id="buttonUp" class="buttonUp active">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
        <path d="M240.971 130.524l194.343 194.343c9.373 9.373 9.373 24.569 0 33.941l-22.667 22.667c-9.357 9.357-24.522 9.375-33.901.04L224 227.495 69.255 381.516c-9.379 9.335-24.544 9.317-33.901-.04l-22.667-22.667c-9.373-9.373-9.373-24.569 0-33.941L207.03 130.525c9.372-9.373 24.568-9.373 33.941-.001z"></path>
    </svg>
</button>

<?
$css=<<< CSS
#buttonUp{
  display: none;
  z-index: 10;
  background: #000000;
  width: 40px;
  height: 40px;
  border-radius: 4px;
  -moz-border-radius: 4px;
  -webkit-border-radius: 4px;
  position: fixed;
  bottom: -100px;
  right: 10px;
  -webkit-transition: all .3s ease-in-out;
  -moz-transition: all .3s ease-in-out;
  -o-transition: all .3s ease-in-out;
  -ms-transition: all .3s ease-in-out;
  transition: all .3s ease-in-out;
  overflow: hidden;
  opacity: .7;
  cursor: pointer;
  outline: none;
  border: none;
}
#buttonUp:hover{
  opacity: 1;
}
#buttonUp svg{
  top: 1px;
  position: relative;
}
#buttonUp svg path{
  fill: #ffffff;
}
#buttonUp.active{
  bottom: 50px;
}
CSS;
$this->registerCss($css, ["type" => "text/css"], "buttonUp" );

$js = <<< JS
$(window).scroll(function () {
    if ($(this).scrollTop() > 200) {
        $('#buttonUp').fadeIn().addClass('active');
    } else {
        $('#buttonUp').fadeOut().removeClass('active');
    }
});

$('#buttonUp').click(function () {
    $('body,html').animate({
        scrollTop: 0
    }, 500);
    return false;
});
<!-- Yandex.Metrika counter -->
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter51172685 = new Ya.Metrika2({
                    id:51172685,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/tag.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks2");
<!-- /Yandex.Metrika counter -->
JS;

    $this->registerJs($js, $position = yii\web\View::POS_END, $key = null);
?>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
