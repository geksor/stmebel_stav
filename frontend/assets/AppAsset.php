<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'public/css/jquery-ui.css',
        'public/css/style.css',
        'public/css/cart.css',
        'public/css/cont.css',
        'public/css/dost.css',
        'public/css/onas.css',
        'public/css/style_menu.css',
        'public/css/mobile.css',
        'public/css/jquery.fancybox.min.css',
        'public/css/owl.carousel.min.css',
        'public/pickr-master/dist/pickr.min.css',

    ];
    public $js = [
        'public/js/jquery.fancybox.min.js',
        'public/js/owl.carousel.min.js',
        'public/js/slideout.js',
        'public/js/owl.carousel.min.js',
        'public/js/modernizr.custom.js',
        'public/js/modernizr.js',
        'public/js/selectbox.js',
        'public/js/jquery.menu-aim.js',
        'public/js/main.js',
        'public/js/mask.lib.js',
        'public/js/xzoom.min.js',
        'public/js/setup.js',
        'public/js/Lib.js',
        'public/js/picker.js',
        'public/pickr-master/dist/pickr.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\jui\JuiAsset',
        'rmrevin\yii\fontawesome\AssetBundle',
    ];
}
