<?php

/* @var $this \frontend\components\View */

$this->title = 'Главная';
?>

<?= \frontend\widgets\CategoryForMainWidget::widget() ?>
<?= \frontend\widgets\ProductsForMainWidget::widget() ?>
<div class="uslugi cont flex_2">
    <div class="usluga">
        <img src="public/img/usluga_1.svg" alt="">
        <h4>ЛЮБЫЕ ФОРМЫ ОПЛАТЫ</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
    </div>
    <div class="usluga">
        <img src="public/img/usluga_2.svg" alt="">
        <h4>СБОРКА И ДОСТАВКА</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
    </div>
    <div class="usluga">
        <img src="public/img/usluga_3.svg" alt="">
        <h4>ГАРАНТИЯ КАЧЕСТВА</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
    </div>
</div>