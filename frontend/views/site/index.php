<?php

use frontend\widgets\ReviewsWidget;

/* @var $this \frontend\components\View */

$this->title = 'Главная - Bro & Bro в Ставрополе';
?>

<?= \frontend\widgets\AboutHomeWidget::widget()?>

<?= \frontend\widgets\AdvantageWidget::widget() ?>

<div id="houses" class="container mw-1200 mt-5 pt-5">
    <div class="row justify-content-center">
        <div class="col-12 mb-5 text-center text-md-left">
            <h2 class="text-center text-lg-left">Строим на века</h2>
        </div>
        <div class="col-11 col-lg-6 text-center">
            <img src="/public/images/house2.jpg" class="img-fluid" alt="">
        </div>
        <div class="col-11 col-lg-6">
            <div class="row mt-4 mt-lg-0 justify-content-center">
                <div class="col-6 text-right text-lg-center">
                    <img src="/public/images/garage.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-6 text-left text-lg-center">
                    <img src="/public/images/fountain.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-12 mt-4">
                    <div class="row bg-gray mx-0 pt-lg-3 pb-lg-5 py-2">
                        <h3 class="col-12 my-2 my-lg-4 text-center text-lg-left">Коттедж «Название»</h3>
                        <div class="col-6 col-md-4 mt-2 text-center text-md-left">
                            <span class="gray mr-1">Общая площадь:</span><span>72 м<sup>2</sup></span><br>
                            <span class="gray mr-1">Количество комнат:</span><span>6</span><br>
                            <span class="gray mr-1">Гараж:</span><span>Есть</span><br>
                        </div>
                        <div class="col-6 col-md-4 mt-2 text-center text-md-left">
                            <span class="gray mr-1">Этажей:</span><span>2</span><br>
                            <span class="gray mr-1">Теплоизоляция:</span><span>120 мм</span><br>
                            <span class="gray mr-1">Фундамент:</span><span>Монолитный</span><br>
                        </div>
                        <div class="col-12 col-md-4 mt-2 text-center align-self-center">
                            <a class="btn btn-outline-primary my-2 my-sm-0 rounded-0" href="#">Подробнее</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-11 col-lg-6 mt-4">
            <div class="row mt-lg-0 justify-content-center">
                <div class="col-6 text-right text-lg-center">
                    <img src="/public/images/garage.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-6 text-left text-lg-center">
                    <img src="/public/images/fountain.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-12 mt-4">
                    <div class="row bg-gray mx-0 pt-lg-3 pb-lg-5 py-2">
                        <h3 class="col-12 my-2 my-lg-4 text-center text-lg-left">Коттедж «Название»</h3>
                        <div class="col-6 col-md-4 mt-2 text-center text-md-left">
                            <span class="gray mr-1">Общая площадь:</span><span>72 м<sup>2</sup></span><br>
                            <span class="gray mr-1">Количество комнат:</span><span>6</span><br>
                            <span class="gray mr-1">Гараж:</span><span>Есть</span><br>
                        </div>
                        <div class="col-6 col-md-4 mt-2 text-center text-md-left">
                            <span class="gray mr-1">Этажей</span><span>2</span><br>
                            <span class="gray mr-1">Теплоизоляция</span><span>120 мм</span><br>
                            <span class="gray mr-1">Фундамент</span><span>Монолитный</span><br>
                        </div>
                        <div class="col-12 col-md-4 mt-2 text-center align-self-center">
                            <a class="btn btn-outline-primary my-2 my-sm-0 rounded-0" href="#">Подробнее</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-11 col-lg-6 text-center mt-4 ">
            <img src="/public/images/house2.jpg" class="img-fluid" alt="">
        </div>
    </div>
    <div class="row mt-4">

    </div>
</div>

<?= \frontend\widgets\ExamplesWidget::widget([
        'title' => 'Примеры нашей мебели',
        'category' => 3,
]) ?>

<?= ReviewsWidget::widget() ?>

<?= \frontend\widgets\PartnerWidget::widget([
    'modelId' => 1,
    'imageCount' => 4,
]) ?>