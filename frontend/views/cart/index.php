<?php

/* @var $this \frontend\components\View */
/* @var $cartProduct */
/* @var $totalPrice */

$this->title = 'Корзина';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="content flex_1">
    <? if ($cartProduct) {?>
        <div class="basket">
        <h1>Оформление заказа</h1>
        <form action="" class="basket_form flex">
            <input type="text" placeholder="Введите ваше имя *">
            <input type="text" placeholder="Номер телефона *">
            <input type="text" placeholder="email (необязательно)">
        </form>
        <div class="basket_left">
            <? if ($cartProduct) {?>
                <? foreach ($cartProduct as $item) {?>
                    <?$productModel = $item['modelProduct'] /* @var $productModel \common\models\Product */ ?>
                    <div class="basket_product flex">
                        <div class="basket_product_img">
                            <img src="<?= $productModel->getThumbMainImage() ?>" alt="">
                        </div>
                        <div class="basket_product_name">
                            <h2><?= $productModel->title ?></h2>
                            <? if ($item['modelProductAttr']) {?>
                                <? foreach ($item['modelProductAttr'] as $prodAttr) { /* @var $prodAttr \common\models\ProductAttr */?>
                                    <p><?= $prodAttr->attr->title ?>:<span> <?= $prodAttr->attrValue->value ?></span></p>
                                <?}?>
                            <?}?>
                            <? if (!$productModel->show_color) {?>
                                <p>Цвет:
                                    <? if ($item['color']) {?>
                                        <span class="basket_product_att" style="background-color: <?= $item['color'] ?>"></span>
                                    <?}else{?>
                                        не выбран
                                    <?}?>
                                </p>
                            <?}?>
                        </div>
                        <div class="basket_price">
                            <?= Yii::$app->formatter->asInteger($productModel->getCalcPrice($item['modelProductAttr'], false)*$item['count']) ?> Р
                        </div>
                        <div class="product_right_cart flex">
                            <div>
                                <div class="number">
                                    <span class="minus">
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="21"><path class="owl_fill" fill-rule="evenodd" d="M11.787 1.838l-8.79 8.646 8.79 8.647a.756.756 0 0 1 0 1.081l-.549.54a.787.787 0 0 1-1.099 0L.25 11.025a.758.758 0 0 1 0-1.081L10.139.217a.785.785 0 0 1 1.099 0l.549.54a.756.756 0 0 1 0 1.081z"></path></svg>
                            </span>
                                    <input type="text" value="<?= $item['count'] ?>" size="5"/>
                                    <span class="plus">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="21"><path class="owl_fill" fill-rule="evenodd" d="M11.778 11.041l-9.913 9.742a.79.79 0 0 1-1.102 0l-.55-.542a.754.754 0 0 1 0-1.082L9.024 10.5.213 1.841a.755.755 0 0 1 0-1.083l.55-.541a.79.79 0 0 1 1.102 0l9.913 9.742a.754.754 0 0 1 0 1.082z"></path></svg>
                            </span>
                                </div>
                            </div>
                        </div>
                        <div class="basket_close">
                            <a href="" class="basket_close">
                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23">
                                    <path fill="#BBC0BE" fill-rule="evenodd" d="M22.813 20.692l-2.121 2.122-9.192-9.193-9.193 9.193-2.121-2.122L9.378 11.5.186 2.307 2.307.186 11.5 9.379 20.692.186l2.121 2.121-9.192 9.193 9.192 9.192z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                <?}?>
            <?}?>
        </div>
        <div class="basket_right">
            <div class="basket_right_1">
                <p>Сумма к оплате:</p>
                <p class="basket_right_price"><?= Yii::$app->formatter->asInteger($totalPrice) ?> Р</p>
            </div>
            <div class="basket_right_2">
                <label class="container">Требуется сборка <a>( +700 руб.)</a>
                    <input type="checkbox" checked="checked">
                    <span class="checkmark"></span>
                </label>
                <label class="container">Доставка по городу <a>( +400 руб.)</a>
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="basket_right_2">
                <h3>Подъем на этаж:</h3>
                <label class="container">Есть грузовой лифт <a>( +300 руб.)</a>
                    <input type="radio" checked="checked" name="radio">
                    <span class="checkmark"></span>
                </label>
                <label class="container">Нет грузовго лифта <a>( +700 руб.)</a>
                    <input type="radio" name="radio">
                    <span class="checkmark"></span>
                </label>
                <label class="container">Не требуется <a>( 0 руб.)</a>
                    <input type="radio" name="radio">
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="basket_right_2">
                <a href="" class="go_by">ПЕРЕЙТИ К ОПЛАТЕ</a>
            </div>
        </div>
    </div>
    <?}else{?>
        <p>корзина пуста</p>
    <?}?>
</div>
