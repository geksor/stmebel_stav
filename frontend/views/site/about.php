<?php

/* @var $this \frontend\components\View */

use yii\helpers\Html;

$this->headerClass = 'about';
$this->title = 'О компании';
$this->params['breadcrumbs'][] = $this->title;
?>

<?= \frontend\widgets\AboutPageWidget::widget()?>

<?= \frontend\widgets\TeamWidget::widget() ?>

<?= \frontend\widgets\HowWeWorkWidget::widget(['modelId' => 1]) ?>

<div id="questions" class="container mw-1200 mt-5">
    <div class="row justify-content-center py-5 mx-0 review">
        <h2 class="col-11 text-center mb-5">Остались вопросы?</h2>
        <div class="col-12 text-center">
            <button class="btn btn-outline-light my-2 my-sm-0 rounded-0" data-toggle="modal" data-target="#callBack">Заказать обратный звонок</button>
        </div>
    </div>
</div>
