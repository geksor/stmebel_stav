<?php

/* @var $this yii\web\View */
/* @var $counter_direct */
/* @var $counter_search */
/* @var $counter_ads */

use yii\helpers\Html;

$this->title = 'Bro & Bro Статистика';
?>
<div class="site-index">
    <p>
        <?= Html::a('Панель статистики', ['/dashboard'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="row">
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
            <div class="info-box">
                <!-- Apply any bg-* class to to the icon to color it -->
                <span class="info-box-icon bg-aqua"><i class="fa fa-arrow-right"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Прямые переходы</span>
                    <span class="info-box-number"><?= $counter_direct ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
            <div class="info-box">
                <!-- Apply any bg-* class to to the icon to color it -->
                <span class="info-box-icon bg-yellow"><i class="fa fa-search"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">По поисковым запросам</span>
                    <span class="info-box-number"><?= $counter_search ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
            <div class="info-box">
                <!-- Apply any bg-* class to to the icon to color it -->
                <span class="info-box-icon bg-red"><i class="fa fa-exclamation-circle"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Рекламные ссылки</span>
                    <span class="info-box-number"><?= $counter_ads ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    </div>
</div>
