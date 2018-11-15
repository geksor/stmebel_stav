<?php

use frontend\widgets\ReviewsWidget;

/* @var $this \frontend\components\View */

$this->title = 'Главная - Bro & Bro в Ставрополе';
?>

<?= \frontend\widgets\AboutHomeWidget::widget()?>

<?= \frontend\widgets\AdvantageWidget::widget() ?>

<?= \frontend\widgets\HouseWidget::widget([
    'title' => 'Строим на века',
    'category' => 14,
]) ?>

<?= \frontend\widgets\ExamplesWidget::widget([
        'title' => 'Примеры нашей мебели',
        'category' => 2,
]) ?>

<?= ReviewsWidget::widget() ?>

<?= \frontend\widgets\PartnerWidget::widget([
    'modelId' => Yii::$app->params['SiteSettings']['homePagePartner_id'],
    'imageCount' => Yii::$app->params['SiteSettings']['homePagePartner_count'],
]) ?>