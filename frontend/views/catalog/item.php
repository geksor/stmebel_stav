<?php

/* @var $this \frontend\components\View */

use yii\helpers\ArrayHelper;

/* @var $model \common\models\Product */
/* @var $modelCat \common\models\Category */


$this->registerMetaTag([
    'name' => 'title',
    'content' => $model->meta_title,
]);
$this->registerMetaTag([
    'name' => 'description',
    'content' => $model->meta_description,
]);

$breads = $modelCat?$modelCat->getParentsFromBread():false;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Каталог мебели', 'url' => ['/catalog']];
if ($breads){
    foreach ($breads as $bread){
        $this->params['breadcrumbs'][] = ['label' => $bread['title'], 'url' => ['index', 'alias' => $bread['alias']]];
    }
}

$this->params['breadcrumbs'][] = ['label' => $modelCat->title, 'url' => ['index', 'alias' => $modelCat->alias]];
$this->params['breadcrumbs'][] = $this->title;
//\yii\helpers\VarDumper::dump($model,10,true);die;
?>
<div class="content flex_1">
    <div class="product_left">
        <h1><?= $model->title ?></h1>
        <div class="rewiev"><a href="">Оставить отзыв</a></div>
        <div class="product_left_img">
            <section id="magnific">
                <div class="row">
                    <div class="large-5 column">
                        <div class="xzoom-container flex_img_product">
                            <div>
                                <img class="xzoom5" id="xzoom-magnific" src="<?= $model->getThumbMainImage() ?>" xoriginal="<?= $model->getZoomMainImage() ?>" />
                            </div>
                            <div class="xzoom-thumbs">
                                <? if ($model->productImages) {?>
                                    <? foreach ($model->productImages as $productImage) {/* @var $productImage \common\models\ProductImages */?>
                                        <? if ($productImage->image === $model->main_image) {?>
                                            <a href="<?= $productImage->getZoomImage() ?>">
                                                <img class="xzoom-gallery5"
                                                     width="80"
                                                     src="<?= $productImage->getThumbImage() ?>"
                                                     xpreview="<?= $productImage->getThumbImage() ?>"
                                                     title="<?= $productImage->title?$productImage->title:$model->title ?>"
                                                >
                                            </a>
                                        <?}?>
                                    <?}?>
                                    <? foreach ($model->productImages as $productImage) {/* @var $productImage \common\models\ProductImages */?>
                                        <? if ($productImage->image !== $model->main_image) {?>
                                            <a href="<?= $productImage->getZoomImage() ?>">
                                                <img class="xzoom-gallery5"
                                                     width="80"
                                                     src="<?= $productImage->getThumbImage() ?>"
                                                     xpreview="<?= $productImage->getThumbImage() ?>"
                                                     title="<?= $productImage->title?$productImage->title:$model->title ?>"
                                                >
                                            </a>
                                        <?}?>
                                    <?}?>
                                <?}?>
                            </div>
                        </div>
                    </div>
                    <div class="large-7 column"></div>
                </div>
            </section>
        </div>
    </div>
    <div class="product_right">
        <div class="product_right_price">
            <p class="product_right_price_0">Цена</p>
            <? \yii\widgets\Pjax::begin(['id' => 'price', 'options' => ['class' => 'product_right_price']]) ?>
                <? if ($model->sale) {?>
                    <p class="product_right_price_1 main-price" ><?= $model->getSaleAttrPrice(true) ?> Р</p>
                    <p class="product_right_price_2"><?= $model->getAttrPrice(true) ?> Р</p>
                <?}else{?>
                    <p class="product_right_price_1 main-price" ><?= $model->getAttrPrice(true) ?> Р</p>
                <?}?>
            <? \yii\widgets\Pjax::end() ?>
        </div>
        <div class="product_right_material">
            <? if ($model->attrsCats) {?>
                <? foreach ($model->attrsCats as $attr) {?>
                    <p><?= $attr->title ?>:</p>
                    <!-- Руднев-->
                    <div class="flex_4">
                        <? $i = 0; foreach ($model->productAttrsCats as $prodAttr) {?>
                            <? if ($prodAttr->attr_id === $attr->id) {?>
                                <span class="input_type_radio">
                                    <input
                                            type="radio"
                                            class="attrInput"
                                            name="attr_id[<?= $attr->id ?>]"
                                            id="attr_id<?= $attr->id.$prodAttr->attrValue_id ?>"
                                            value="<?= $prodAttr->attrValue_id ?>"
                                            data-attr="<?= $attr->id ?>"
                                            <?= $i===0?'checked="checked"':'' ?>
                                    >
                                    <label for="attr_id<?= $attr->id.$prodAttr->attrValue_id ?>">
                                        <span class="radio_attr_label"><?= $prodAttr->attrValue->value ?></span>
                                    </label>
                                </span>
                            <?$i++;}?>
                        <?}?>
                    </div>
                    <!-- Руднев-->
                <?}?>
            <?}?>
        </div>
        <div class="product_right_material">
            <? if (!$model->show_color) {?>
                <div>
                Цвет:
                <div class="prodColorBlock" style="
                        width: 20px;
                        height: 20px;
                        line-height: 0;
                        vertical-align: middle;
                        margin: 5px;
                        display: inline-block;
                        background: url('/public/img/gradien.jpeg');
                        background-size: cover;
                ">
                </div>
                <a id="opener">Выбрать</a>
            </div>
            <?}?>
        </div>
        <!-- Руднев-->

        <div class="picker picker_no" id="primary_block" >

            <div id="line">
                <div id="arrows">
                    <div class="left_arrow"></div>
                    <div class="right_arrow"></div>
                </div>
            </div>

            <div id="block_picker">

                <img src="https://lh3.googleusercontent.com/-8Dm4nhAOssQ/T_IqwyIFXmI/AAAAAAAAACA/4QKmS7s_otE/s256/bgGradient.png" class="bk_img"><div class="circle" id="circle"></div>
            </div>
            <div id="out_color" class="out_color">
                <p id ="closer">Выбрать</p>
            </div>
        </div>
        <!-- Руднев-->
        <div class="product_right_material">
            <p>Наличие: <span><?= $model->avail?'В наличии':'Под заказ' ?></span></p>
            <p>Код товара: <span><?= $model->code ?></span></p>
            <? if ($model->productOptionsShort) {?>
                <? foreach ($model->productOptionsShort as $option) {?>
                    <p>
                        <?= $option->options->title ?>:
                        <span>
                            <?= $option->optionsValue_id?$option->optionsValue->value:$option->options_value ?>
                        </span>
                    </p>
                <?}?>
            <?}?>

        </div>
        <div class="product_right_cart flex">
            <p class="product_right_cart_p"><label for="prodCount">Количество:</label></p>
            <div>
                <div class="number">
                    <span class="minus">
                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="21"><path class="owl_fill" fill-rule="evenodd" d="M11.787 1.838l-8.79 8.646 8.79 8.647a.756.756 0 0 1 0 1.081l-.549.54a.787.787 0 0 1-1.099 0L.25 11.025a.758.758 0 0 1 0-1.081L10.139.217a.785.785 0 0 1 1.099 0l.549.54a.756.756 0 0 1 0 1.081z"></path></svg>
                    </span>
                    <input id="prodCount" type="text" value="1" size="5"/>
                    <span class="plus">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="21"><path class="owl_fill" fill-rule="evenodd" d="M11.778 11.041l-9.913 9.742a.79.79 0 0 1-1.102 0l-.55-.542a.754.754 0 0 1 0-1.082L9.024 10.5.213 1.841a.755.755 0 0 1 0-1.083l.55-.541a.79.79 0 0 1 1.102 0l9.913 9.742a.754.754 0 0 1 0 1.082z"></path></svg>
                            </span>
                </div>
            </div>
            <div class="fill_cart_by_flex">
                <a
                    href="/catalog/add-cart"
                    id="addToCart"
                    class="fill_cart_by"
                    data-prod_id="<?= $model->id ?>"
                    data-prod_price="<?= $model->sale?$model->saleAttrPrice:$model->attrPrice ?>"
                    data-prod_count="1"
                    data-prod_attrValue=""
                    data-color=""
                >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36 36">
                        <path class="fill_cart_product" fill-rule="evenodd" d="M34.332 5.76H8.943L7.481 2.328a1.204 1.204 0 0 0-.83-.698L1.94.524a1.2 1.2 0 1 0-.55 2.334l4.119.968L16.05 28.568a3.935 3.935 0 0 0-.513 1.947 3.972 3.972 0 0 0 7.943 0c0-.549-.113-1.072-.316-1.549h4.325c-.203.477-.315 1-.315 1.549a3.972 3.972 0 0 0 7.943 0 3.972 3.972 0 0 0-3.971-3.965l-13.337.018-1.645-3.86h18.169a1.2 1.2 0 0 0 1.201-1.199V6.96a1.201 1.201 0 0 0-1.202-1.2zm-3.185 23.189c.867 0 1.57.702 1.57 1.567a1.569 1.569 0 0 1-3.139 0c0-.865.703-1.567 1.569-1.567zm-11.633 0a1.568 1.568 0 1 1 0 3.134 1.569 1.569 0 0 1-1.569-1.567c0-.865.703-1.567 1.569-1.567zm13.618-15.914h-7.961a1.2 1.2 0 1 0 0 2.398h7.961v4.877h-17.99L9.965 8.158h23.167v4.877z"/>
                    </svg>
                    <span>В корзину</span>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="cont">
    <div id="tabs_1">
        <ul>
            <? if ($model->productOptionsAll) {?>
                <li><a href="#alloptions">Все характеристики</a></li>
            <?}?>
            <? if ($model->description) {?>
                <li><a href="#description">ОПИСАНИЕ</a></li>
            <?}?>
            <li><a href="#reviews">Отзывы</a></li>
        </ul>
        <? if ($model->productOptionsAll) {?>
            <div id="alloptions">
                <? foreach ($model->productOptionsAll as $option) {/* @var $option \common\models\ProductOptions */?>
                    <div class="product_full_description">
                        <h4><?= $option->options->title ?>:</h4>
                        <p><?= $option->optionsValue_id?$option->optionsValue->value:$option->options_value ?></p>
                    </div>
                <?}?>
            </div>
        <?}?>
        <? if ($model->description) {?>
            <div id="description">
                <?= $model->description ?>
            </div>
        <?}?>
        <div id="reviews"></div>


        </div>
    <? if ($model->recommProducts) {?>
        <div class="products">
            <div id="tabs">
                <ul>
                    <li><a href="#tabs-1">РЕКОМЕНДУЕМЫЕ ТОВАРЫ</a></li>
                </ul>
                <div id="tabs-1">
                    <div class="slider1 owl-carousel owl-theme flex">
                        <? $i = 1 ?>
                        <? foreach ($model->recommProducts as $recommProduct) {?>
                            <div class="product item<?= $i === 5?' product_border':'' ?> carusel">
                                <? if ($recommProduct->sale) {?>
                                    <div class="sale">
                                        <p>-<?= $recommProduct->sale ?>%</p>
                                    </div>
                                <?}?>
                                <? if ($recommProduct->hot) {?>
                                    <div class="sale hot">
                                        <p>Хит продаж</p>
                                    </div>
                                <?}?>
                                <? if ($recommProduct->new) {?>
                                    <div class="sale new">
                                        <p>Новинка</p>
                                    </div>
                                <?}?>
                                <div class="product_img">
                                    <a href="<?= \yii\helpers\Url::to(['catalog/item', 'alias' => $recommProduct->mainCat->alias, 'item' => $recommProduct->alias]) ?>"><img src="<?= $recommProduct->getThumbMainImage() ?>" alt="<?= $recommProduct->title ?>"></a>
                                </div>
                                <div class="product_name">
                                    <?= $recommProduct->title ?>
                                </div>
                                <div class="product_description">
                                    <? if ($recommProduct->productOptionsList) {?>
                                        <? foreach ($recommProduct->productOptionsList as $productOption) {/* @var $productOption \common\models\ProductOptions */?>
                                            <?= $productOption->options->title ?>: <?= $productOption->options_value?$productOption->options_value:$productOption->optionsValue->value ?>
                                        <?}?>
                                    <?}?>
                                </div>
                                <div class="product_price flex">
                                    <? if ($recommProduct->sale) {?>
                                        <div class="price_1">
                                            <p><?= $recommProduct->getSaleAttrPrice(true) ?> Р</p>
                                        </div>
                                        <div class="price_2">
                                            <p><?= $recommProduct->getAttrPrice(true) ?> Р</p>
                                        </div>
                                    <?}else{?>
                                        <div class="price_1">
                                            <p><?= $recommProduct->getAttrPrice(true) ?> Р</p>
                                        </div>
                                    <?}?>
                                </div>
                                <div class="product_read">
                                    <a href="/catalog/<?= $recommProduct->mainCat->alias ?>/<?= $recommProduct->alias ?>">Подробнее</a>
                                </div>
                            </div>
                            <? $i === 5?$i=1:$i++ ?>
                        <?}?>
                    </div>
                </div>
            </div>
        </div>
    <?}?>
</div>

<?php
$css= <<< CSS

.imgWrap{
    padding-top: 66.66%;    
}
.imgFit{
    width: 100%;
    height: 100%;
    object-fit: cover;
    top: 0;
    left: 0;    
}

CSS;

$this->registerCss($css, ["type" => "text/css"], "callBack" );
$this->registerCssFile('/public/css/xzoom.css');
?>
<?
    $js = <<< JS
    $(document).ready(function (){
        var input = $('#prodCount');
        $('.minus').click(function () {
                var count = parseInt(input.val()) - 1;
                count = count < 1 ? 1 : count;
                input.val(count);
                input.change();
                return false;
            });
        $('.plus').click(function () {
            input.val(parseInt(input.val()) + 1);
            input.change();
            return false;
        });
        
        var prodAttrValue = [];
        $('.attrInput:checked').each(function() {
            prodAttrValue.push($(this).val());//data-attr = attrId, val = valueId
        });
        prodAttrValue = JSON.stringify(prodAttrValue);
        $('#addToCart').attr('data-prod_attrValue', prodAttrValue);

        input.on('change', function() {
            $('#addToCart').attr('data-prod_count', input.val())
        });
            
        $('selector').selectbox();
        
        $('.attrInput').on('change', function() {
            var checkedAttr = [];
            var checkedVal = [];
            $('.attrInput:checked').each(function() {
                checkedVal.push($(this).val());//data-attr = attrId, val = valueId
                checkedAttr.push($(this).attr('data-attr'));//data-attr = attrId, val = valueId
            });
            checkedVal = JSON.stringify(checkedVal);
            checkedAttr = JSON.stringify(checkedAttr);
            $('#addToCart').attr('data-prod_attrValue', checkedVal);

            
            $.pjax.reload({
                container: '#price',
                type       : 'GET',
                url        : '/catalog/calc-price',
                data       : {
                    id: $model->id,
                    attrsId: checkedAttr,
                    valuesId: checkedVal
                },
                push       : false,
                replace    : false,
                timeout    : 1000,
            });
        });
        $('#price').on('pjax:end', function() {
            $('#addToCart').attr('data-prod_price', $('.main-price').attr('data-price'));
        })
    });

    picker.init();
    $('#opener').on('click',function() {
        $('#primary_block').addClass('picker_yes')
    });
    $('#closer').on('click',function() {
        $('#primary_block').removeClass('picker_yes');
        var color = $('#out_color').css('background-color');
        $('.prodColorBlock').css('background', color);
        $('#addToCart').attr('data-color', color);
    });
JS;

    $this->registerJs($js, $position = yii\web\View::POS_END, $key = null);
?>

