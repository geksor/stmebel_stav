<?php

/* @var $this \frontend\components\View */

use yii\widgets\ActiveForm;

/* @var $cartProduct */
/* @var $totalPrice */
/* @var $cartOptCheckbox */
/* @var $cartOptRadio */
/* @var $orderCheckOptions \common\models\OrderOptCheckbox */
/* @var $orderRadioOption \common\models\OrderOptRbSec */
/* @var $orderForm \frontend\models\OrderEnd */

$this->title = 'Корзина';
$this->params['breadcrumbs'][] = $this->title;
?>

<? \yii\widgets\Pjax::begin(['id' => 'cart']) ?>
    <div class="content flex_1">
        <? if ($cartProduct) {?>
            <div class="basket">
            <h1>Оформление заказа</h1>

            <?php $form = ActiveForm::begin([
                'action' => '/cart/save-order',
                'options' => [
                    'class' => 'basket_form flex'
                ]
            ]); ?>

                <?= $form->field($orderForm, 'customer_name')->textInput(['maxlength' => true, 'placeholder' => 'Введите ваше имя *'])->label(false) ?>

                <?= $form->field($orderForm, 'customer_phone')->textInput(['maxlength' => true, 'placeholder' => 'Номер телефона *'])->label(false) ?>

                <?= $form->field($orderForm, 'customer_email')->textInput(['maxlength' => true, 'placeholder' => 'email (необязательно)'])->label(false) ?>

                <div style="display: none!important;">

                    <?= $form->field($orderForm, 'props_checkbox')->hiddenInput()->label(false) ?>

                    <?= $form->field($orderForm, 'props_radiobutton')->hiddenInput()->label(false) ?>

                    <?= $form->field($orderForm, 'products')->hiddenInput()->label(false) ?>

                    <?= $form->field($orderForm, 'total_price')->hiddenInput()->label(false) ?>

                    <?= \yii\helpers\Html::submitButton('', ['class' => 'orderFormSubmit']) ?>

                </div>

            <? ActiveForm::end() ?>

            <div class="basket_left">
                <? if ($cartProduct) {?>
                    <? foreach ($cartProduct as $key => $item) {?>
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
                            <div class="basket_price" id="<?= $key ?>">
                                <?= Yii::$app->formatter->asInteger($productModel->getCalcPrice($item['modelProductAttr'], false)*$item['count']) ?> <i class="fas fa-ruble-sign"></i>
                            </div>
                            <div class="product_right_cart flex">
                                <div>
                                    <div class="number">
                                        <span class="minus"
                                              data-item="<?= $key ?>"
                                              data-prod_id="<?= $productModel->id ?>"
                                              data-attr_value='<?= \yii\helpers\Json::encode($item['attrValue']) ?>'
                                              data-color='<?= $item['color'] ?>'
                                        >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="21"><path class="owl_fill" fill-rule="evenodd" d="M11.787 1.838l-8.79 8.646 8.79 8.647a.756.756 0 0 1 0 1.081l-.549.54a.787.787 0 0 1-1.099 0L.25 11.025a.758.758 0 0 1 0-1.081L10.139.217a.785.785 0 0 1 1.099 0l.549.54a.756.756 0 0 1 0 1.081z"></path></svg>
                                </span>
                                        <input class="countInput" type="text" value="<?= $item['count'] ?>" size="5" id="count<?= $key ?>" "/>
                                        <span class="plus"
                                              data-item="<?= $key ?>"
                                              data-prod_id="<?= $productModel->id ?>"
                                              data-attr_value='<?= \yii\helpers\Json::encode($item['attrValue']) ?>'
                                              data-color='<?= $item['color'] ?>'
                                        >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="21"><path class="owl_fill" fill-rule="evenodd" d="M11.778 11.041l-9.913 9.742a.79.79 0 0 1-1.102 0l-.55-.542a.754.754 0 0 1 0-1.082L9.024 10.5.213 1.841a.755.755 0 0 1 0-1.083l.55-.541a.79.79 0 0 1 1.102 0l9.913 9.742a.754.754 0 0 1 0 1.082z"></path></svg>
                                </span>
                                    </div>
                                </div>
                            </div>
                            <div class="basket_close">
                                <a href="" class="basket_close delProduct"
                                   data-item="<?= $key ?>"
                                   data-prod_id="<?= $productModel->id ?>"
                                   data-attr_value='<?= \yii\helpers\Json::encode($item['attrValue']) ?>'
                                   data-color='<?= $item['color'] ?>'
                                >
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
                    <p class="basket_right_price"><?= Yii::$app->formatter->asInteger($totalPrice) ?> <i class="fas fa-ruble-sign"></i></p>
                </div>
                <? if ($orderCheckOptions) {?>
                    <div class="basket_right_2">
                        <? foreach ($orderCheckOptions as $checkOption) {/* @var $checkOption \common\models\OrderOptCheckbox */?>
                            <label class="container"><?= $checkOption->title ?> <a>(
                                    <? if ($checkOption->addPrice) {?>
                                        +<?= $checkOption->addPrice ?> руб.
                                    <?}else{?>
                                        Бесплатно
                                    <?}?>
                                    )</a>
                                <input class="checkboxCart"
                                    <?=
                                        \yii\helpers\ArrayHelper::isIn($checkOption->id, Yii::$app->session->get('cart')['select_option']['checkbox'])
                                            ?'checked'
                                            :'';
                                    ?>
                                    type="checkbox" data-id="<?= $checkOption->id ?>">
                                <span class="checkmark"></span>
                            </label>
                        <?}?>
                    </div>
                <?}?>

                <? if ($orderRadioOption) {?>
                    <div class="basket_right_2">
                        <? foreach ($orderRadioOption as $radioOption) {/* @var $radioOption \common\models\OrderOptRbSec */?>
                            <? if ($radioOption->orderOptRbItems) {?>
                                <h3><?= $radioOption->title ?>:</h3>
                                <? foreach ($radioOption->orderOptRbItems as $optRbItem) {?>
                                    <label class="container"><?= $optRbItem->title ?> <a>
                                            (
                                            <? if ($radioOption->addPrice) {?>
                                                +<?= $radioOption->addPrice ?> руб.
                                            <?}else{?>
                                                Бесплатно
                                            <?}?>
                                            )
                                        </a>
                                        <input class="radioCart"
                                            <?=
                                            \yii\helpers\ArrayHelper::isIn($optRbItem->id, Yii::$app->session->get('cart')['select_option']['radio'])
                                                ?'checked'
                                                :'';
                                            ?>
                                        type="radio" name="radio<?= $radioOption->id ?>" data-id="<?= $optRbItem->id ?>">
                                        <span class="checkmark"></span>
                                    </label>
                                <?}?>
                            <?}?>
                        <?}?>
                    </div>
                <?}?>

                <div class="basket_right_2">
                    <button class="go_by">Заказать</button>
                </div>
            </div>
        </div>
        <?}else{?>
            <p>корзина пуста</p>
        <?}?>
    </div>

<?

$js = <<< JS
    $(document).ready(function (){
        $('.minus').click(function () {
            var count = parseInt($('#count'+$(this).attr('data-item')).val()) - 1;
            count = count < 1 ? 1 : count;
            $('#count'+$(this).attr('data-item')).val(count);
            var prod_id = $(this).attr('data-prod_id');
            var attrValue = $(this).attr('data-attr_value');
            var color = $(this).attr('data-color');
            $.pjax.reload({
                container: '#cart',
                type       : 'GET',
                url        : '/cart',
                data       : {
                    prod_id: prod_id,
                    count: count,
                    attrValue: attrValue,
                    color: color
                },
                push       : false,
                replace    : false,
                timeout    : 1000,
            });
            return false;
        });
        $('.plus').click(function () {
            var count = parseInt($('#count'+$(this).attr('data-item')).val()) + 1;
            $('#count'+$(this).attr('data-item')).val(count);
            var prod_id = $(this).attr('data-prod_id');
            var attrValue = $(this).attr('data-attr_value');
            var color = $(this).attr('data-color');
            $.pjax.reload({
                container: '#cart',
                type       : 'GET',
                url        : '/cart',
                data       : {
                    prod_id: prod_id,
                    count: count,
                    attrValue: attrValue,
                    color: color
                },
                push       : false,
                replace    : false,
                timeout    : 1000,
            });
            return false;
        });
        
        $('.delProduct').click(function () {
            var count = parseInt($('#count'+$(this).attr('data-item')).val());
            var prod_id = $(this).attr('data-prod_id');
            var attrValue = $(this).attr('data-attr_value');
            var color = $(this).attr('data-color');
            $.pjax.reload({
                container: '#cart',
                type       : 'GET',
                url        : '/cart',
                data       : {
                    del: true,
                    prod_id: prod_id,
                    count: count,
                    attrValue: attrValue,
                    color: color
                },
                push       : false,
                replace    : false,
                timeout    : 1000,
            });
            return false;
        });
        
        $('.checkboxCart').on('change', function() {
            var checkboxArr = $cartOptCheckbox;
            var optId = $(this).attr('data-id');
            if ($(this).prop('checked')){
                var isNewRecord = true;
                $.each(checkboxArr, function(value) {
                    if (+value === +optId){
                        isNewRecord = false;
                    } 
                });
                if (isNewRecord){
                    checkboxArr.splice(0, 0, optId);
                } 
            }else{
                checkboxArr = $.grep(checkboxArr, function(value) {
                    return +value !== +optId;
                })
            }
            checkboxArr = JSON.stringify(checkboxArr);
            $.pjax.reload({
                container: '#cart',
                type       : 'GET',
                url        : '/cart',
                data       : {
                    checkBox: checkboxArr,
                },
                push       : false,
                replace    : false,
                timeout    : 1000,
            });
        });        
        $('.radioCart').on('change', function() {
            var radioArr = $cartOptRadio;
            $.each($('[name='+$(this).attr('name')+']'), function() {
                var optId = $(this).attr('data-id');
                if ($(this).prop('checked')){
                    var isNewRecord = true;
                    $.each(radioArr, function(value) {
                        if (+value === +optId){
                            isNewRecord = false;
                        } 
                    });
                    if (isNewRecord){
                        radioArr.splice(0, 0, optId);
                    } 
                }else{
                    radioArr = $.grep(radioArr, function(value) {
                        return +value !== +optId;
                    })
                }
            });
            radioArr = JSON.stringify(radioArr);
            $.pjax.reload({
                container: '#cart',
                type       : 'GET',
                url        : '/cart',
                data       : {
                    radio: radioArr,
                },
                push       : false,
                replace    : false,
                timeout    : 1000,
            });
        });
        $('.go_by').on('click', function() {
            $('.orderFormSubmit').trigger('click');
        });
    });
JS;

$this->registerJs($js, $position = yii\web\View::POS_END, $key = null);
?>

<? \yii\widgets\Pjax::end() ?>

<?
$jsNoReload = <<<JS
    $(document).ready(function() {
          $('#cart').on('pjax:end', function() {
            $.pjax.reload({
                container: '#cartWidget',
                url        : '/cart/cart-widget',
                push       : false,
                replace    : false,
                timeout    : 1000,
            });
        })

    })
JS;
$this->registerJs($jsNoReload, $position = yii\web\View::POS_END, $key = null);
?>
