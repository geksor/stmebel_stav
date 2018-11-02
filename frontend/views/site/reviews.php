<?php

/* @var $this \frontend\components\View */
/* @var $model \common\models\Comment */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->headerClass = 'reviews-page';
$this->title = 'Отзывы';
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="reviews-text" class="container mw-1200 mt-5 pt-5">
    <div class="row justify-content-center justify-content-lg-between">
        <div class="col-11 col-lg-12 text-justify text-lg-left">
            <? foreach ($model as $item) {/* @var $item \common\models\Comment */?>
                <p class="font-weight-bold mb-1">
                    <span class="name-blue">
                        <?= $item->user_name ?>,&nbsp;</span>
                    <span class="date-review">
                        <?= Yii::$app->formatter->asDate($item->created_at, 'long') ?>
                    </span>
                </p>
                <p>
                    <?= $item->text ?>
                </p>
            <?}?>
        </div>
    </div>
</div>
<div id="reviews-form" class="container mw-1200 mt-5">
    <div class="row justify-content-center py-5 mx-0 review">
        <h2 class="col-11 text-center mb-5">Оставь свой отзыв</h2>
        <form class="col-11 col-md-8">
            <div class="form-row">
                <div class="form-group col-12 col-md-6">
                    <input type="text" class="custom-form-control form-control rounded-0 bg-transparent text-white" id="username" placeholder="ФИО">
                </div>
                <div class="form-group col-12 col-md-6">
                    <input type="email" class="custom-form-control form-control rounded-0 bg-transparent text-white" id="email" placeholder="E-mail">
                </div>
            </div>
            <div class="form-group">
                <textarea type="text"  class="custom-form-control form-control rounded-0 bg-transparent text-white" rows="5" id="comment" placeholder="Текст сообщения..."></textarea>
            </div>
            <div class="col-auto my-1 pl-0">
                <div class="custom-control custom-checkbox mr-sm-2">
                    <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                    <label class="custom-control-label small text-muted" for="customControlAutosizing">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </label>
                </div>
            </div>
            <div class="col-12 text-center mt-3">
                <button type="submit" class="btn btn-outline-light my-2 my-sm-0 rounded-0">Отправить отзыв</button>
            </div>
        </form>
    </div>
</div>
