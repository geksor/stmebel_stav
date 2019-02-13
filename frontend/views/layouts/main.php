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
    <!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script><![endif]-->
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?> - <?= Yii::$app->name ?></title>
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
    <meta name="msapplication-TileColor" content="#ecf0ee">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ecf0ee">
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrapper">

    <?= $this->render('header') ?>

    <? if (Yii::$app->request->url === Yii::$app->homeUrl) {?>
        <?= \frontend\widgets\SliderWidget::widget() ?>
    <?}else{?>
        <div class="content cont">
            <div class="breads">
                <?=
                Breadcrumbs::widget(
                    [
                        'itemTemplate' => '<li>{link}</li>',
                        'activeItemTemplate' => '<li>{link}</li>',
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]
                ) ?>
            </div>
        </div>
    <?}?>

    <main class="content <? if (Yii::$app->request->url !== Yii::$app->homeUrl) {?>cont flex_3<?}?>">
        <?= $content ?>
    </main>

    <?= $this->render('footer') ?>

</div>

<?= \frontend\widgets\ModalsWidget::widget() ?>

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
  left: 10px;
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
    
    $( function() {
        $( "#tabs" ).tabs();
    } );
    $( function() {
        $( "#tabs_1" ).tabs();
    } );
    $( function() {
        $( "#tabs_2" ).tabs();
    } );
    
    $('selector').selectbox();
    
    $('.slider1').owlCarousel({
        loop:true,
        margin:0,
        nav:true,
        responsive:{
            0:{
                items:2
            },
            500:{
                items:3
            },
            1000:{
                items:5
            }
        }
    });
    $('.slider2').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        responsive:{
            0:{
                items:1
            }
        }
    });
    $('.slider3').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            700:{
                items:2
            },
    
            1000:{
                items:4
            }
        }
    });
    
      (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(52218184, "init", {
        id:52218184,
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
JS;

$this->registerJs($js, $position = yii\web\View::POS_END, $key = null);
?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
