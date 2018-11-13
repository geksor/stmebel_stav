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
        'public/style/bootstrap-grid.min.css',
        'public/style/bootstrap-reboot.min.css',
        'public/style/bootstrap.min.css',
        'public/style/jquery.fancybox.min.css',
        'public/style/style.css',
        'public/style/mobile.css',
        'public/style/slick.css',
    ];
    public $js = [
        'public/js/jquery.fancybox.min.js',
        'public/js/slick.min.js',
        'public/js/mask.lib.js',
        'public/js/main.js',
        'public/js/bootstrap.min.js',
        'public/js/bootstrap.bundle.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\jui\JuiAsset',
        'rmrevin\yii\fontawesome\AssetBundle',
    ];
}
