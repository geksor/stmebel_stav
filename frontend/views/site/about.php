<?php

/* @var $this \frontend\components\View */

use yii\helpers\Html;

$this->headerClass = 'about';
$this->title = 'О компании';
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="about-text" class="container mw-1200 mt-5 pt-5">
    <div class="row justify-content-center justify-content-lg-between">
        <div class="col-11 col-lg-6 text-justify text-lg-left">
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et
                quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit
                aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi
                nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit,
                sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.
            </p>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et
                quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit
                aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi
                nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit,
                sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.
            </p>
        </div>
        <div class="col-11 col-lg-5 mt-3 mt-lg-0 text-center">
            <img src="/public/images/about/house.jpg" class="img-fluid" alt="">
        </div>
    </div>
</div>

<?= \frontend\widgets\TeamWidget::widget() ?>

<?= \frontend\widgets\HowWeWorkWidget::widget(['modelId' => 1]) ?>

<div id="questions" class="container mw-1200 mt-5">
    <div class="row justify-content-center py-5 mx-0 review">
        <h2 class="col-11 text-center mb-5">Остались вопросы?</h2>
        <div class="col-12 text-center">
            <a class="btn btn-outline-light my-2 my-sm-0 rounded-0" href="#">Заказать обратный звонок</a>
        </div>
    </div>
</div>
