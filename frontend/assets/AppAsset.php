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
    ];
    public $js = [
        'public/js/jquery.fancybox.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
