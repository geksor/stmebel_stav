<?php

/* @var $this \frontend\components\View */

use yii\helpers\ArrayHelper;

/* @var $model \common\models\Product */
/* @var $modelCat \common\models\Category */
/* @var $alias \frontend\controllers\CatalogController */
/* @var $child \frontend\controllers\CatalogController */


$this->registerMetaTag([
    'name' => 'title',
    'content' => $model->meta_title,
]);
$this->registerMetaTag([
    'name' => 'description',
    'content' => $model->meta_description,
]);

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Каталог товаров', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $modelCat->title, 'url' => ['index', 'alias' => $modelCat->alias]];
$this->params['breadcrumbs'][] = $this->title;
//\yii\helpers\VarDumper::dump($model,10,true);die;
?>

<div class="content flex_1">
    <div class="product_left">
        <h1><?= $model->title ?></h1>
        <div class="rewiev"><a href="">Отзывы</a><a href="">Оставить отзыв</a></div>
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
            <? if ($model->sale) {?>
                <p class="product_right_price_1"><?= Yii::$app->formatter->asInteger($model->newPrice) ?> ₽</p>
                <p class="product_right_price_2"><?= Yii::$app->formatter->asInteger($model->price) ?> ₽</p>
            <?}else{?>
                <p class="product_right_price_1"><?= Yii::$app->formatter->asInteger($model->price) ?> ₽</p>
            <?}?>
        </div>
        <div class="product_right_material">
            <p>Материал: <a href="">Искусственная кожа</a></p>
            <p>Цвет: <a href="">Выбрать</a></p>
        </div>
        <div class="product_right_material">
            <p>Наличие: <span><?= $model->avail?'В наличии':'Под заказ' ?></span></p>
            <p>Арт: <span><?= $model->code ?></span></p>
            <p>Производитель: <span>Россия</span></p>
            <p>Гарантия: <span>12 мес.</span></p>
            <p>Коллекция: <span>Бюджет</span></p>
            <p>Размеры (ШхВхГ): <span>50х90(103)х58 см</span></p>
            <p>Максимальная нагрузка: <span>90 кг</span></p>
        </div>
        <div class="product_right_cart flex">
            <p class="product_right_cart_p">Количество:</p>
            <div>
                <div class="number">
                            <span class="minus">
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="21"><path class="owl_fill" fill-rule="evenodd" d="M11.787 1.838l-8.79 8.646 8.79 8.647a.756.756 0 0 1 0 1.081l-.549.54a.787.787 0 0 1-1.099 0L.25 11.025a.758.758 0 0 1 0-1.081L10.139.217a.785.785 0 0 1 1.099 0l.549.54a.756.756 0 0 1 0 1.081z"></path></svg>
                            </span>
                    <input type="text" value="1" size="5"/>
                    <span class="plus">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="21"><path class="owl_fill" fill-rule="evenodd" d="M11.778 11.041l-9.913 9.742a.79.79 0 0 1-1.102 0l-.55-.542a.754.754 0 0 1 0-1.082L9.024 10.5.213 1.841a.755.755 0 0 1 0-1.083l.55-.541a.79.79 0 0 1 1.102 0l9.913 9.742a.754.754 0 0 1 0 1.082z"></path></svg>
                            </span>
                </div>
            </div>
            <div class="fill_cart_by_flex">
                <a href="" class="fill_cart_by">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36 36">
                        <path class="fill_cart_product" fill-rule="evenodd" d="M34.332 5.76H8.943L7.481 2.328a1.204 1.204 0 0 0-.83-.698L1.94.524a1.2 1.2 0 1 0-.55 2.334l4.119.968L16.05 28.568a3.935 3.935 0 0 0-.513 1.947 3.972 3.972 0 0 0 7.943 0c0-.549-.113-1.072-.316-1.549h4.325c-.203.477-.315 1-.315 1.549a3.972 3.972 0 0 0 7.943 0 3.972 3.972 0 0 0-3.971-3.965l-13.337.018-1.645-3.86h18.169a1.2 1.2 0 0 0 1.201-1.199V6.96a1.201 1.201 0 0 0-1.202-1.2zm-3.185 23.189c.867 0 1.57.702 1.57 1.567a1.569 1.569 0 0 1-3.139 0c0-.865.703-1.567 1.569-1.567zm-11.633 0a1.568 1.568 0 1 1 0 3.134 1.569 1.569 0 0 1-1.569-1.567c0-.865.703-1.567 1.569-1.567zm13.618-15.914h-7.961a1.2 1.2 0 1 0 0 2.398h7.961v4.877h-17.99L9.965 8.158h23.167v4.877z"/>
                    </svg>
                    <p>В корзину</p>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="cont">
    <div id="tabs_1">
        <ul>
            <li><a href="#tabs-1">ОПИСАНИЕ</a></li>
            <li><a href="#tabs-2">Отзывы</a></li>
        </ul>
        <div id="tabs-1">
            <div class="product_full_description">
                <h4>Упаковка:</h4>
                <p>Коробка (ШхВхГ)6 590х580х280 мм</p>
                <p>Общий вес: 9 кг</p>
            </div>
            <div class="product_full_description">
                <h4>Сидение и спинка:</h4>
                <p>Мягкие, обитые сидение и спинка</p>
            </div>
            <div class="product_full_description">
                <h4>Подлокотники:</h4>
                <p>Пластиковые подлокотники</p>
            </div>
            <div class="product_full_description">
                <h4>Механизм</h4>
                <p>Обеспеччивает свободное качание. Возможность фиксации сидения и спинки в одном положении. Регулировка силы отклонения</p>
            </div>
            <div class="product_full_description">
                <h4>База</h4>
                <p>Металлическая с пластиковыми накладками</p>
            </div>
            <div class="product_full_description">
                <h4>Ролики</h4>
                <p>Предлагаются два типа роликов: для твердых поверхностей и ковровых покрытий</p>
            </div>
            <div class="product_full_description">
                <h4>Другие свойства и опции</h4>
                <p>Регулируемая высота сидения. На нерабочих поверхностях допускаяется использование искусственной кожи</p>
            </div>
        </div>
    </div>
    <div class="products">
        <div id="tabs">
            <ul>
                <li><a href="#tabs-1">РЕКОМЕНДУЕМОЕ ВАМ</a></li>
            </ul>
            <div id="tabs-1">
                <div class="slider1 owl-carousel owl-theme flex">
                    <div class="product item">
                        <div class="sale">
                            <p>-10%</p>
                        </div>
                        <div class="product_img">
                            <img src="img/product.jpg" alt="">
                        </div>
                        <div class="product_name">
                            Кресло «Бюджет»
                        </div>
                        <div class="product_description">
                            Цвета: коричневый, чёрный, белый
                        </div>
                        <div class="product_price flex">
                            <div class="price_1">
                                <p>4 250 ₽</p>
                            </div>
                            <div class="price_2">
                                <p>5 130 ₽</p>
                            </div>
                        </div>
                        <div class="product_read">
                            <a href="/product.php">Подробнее</a>
                        </div>
                    </div>
                    <div class="product item">
                        <div class="sale">
                            <p>-10%</p>
                        </div>
                        <div class="product_img">
                            <img src="img/product.jpg" alt="">
                        </div>
                        <div class="product_name">
                            Кресло «Бюджет»
                        </div>
                        <div class="product_description">
                            Цвета: коричневый, чёрный, белый
                        </div>
                        <div class="product_price flex">
                            <div class="price_1">
                                <p>4 250 ₽</p>
                            </div>
                            <div class="price_2">
                                <p>5 130 ₽</p>
                            </div>
                        </div>
                        <div class="product_read">
                            <a href="/product.php">Подробнее</a>
                        </div>
                    </div>
                    <div class="product item">
                        <div class="sale">
                            <p>-10%</p>
                        </div>
                        <div class="product_img">
                            <img src="img/product.jpg" alt="">
                        </div>
                        <div class="product_name">
                            Кресло «Бюджет»
                        </div>
                        <div class="product_description">
                            Цвета: коричневый, чёрный, белый
                        </div>
                        <div class="product_price flex">
                            <div class="price_1">
                                <p>4 250 ₽</p>
                            </div>
                            <div class="price_2">
                                <p>5 130 ₽</p>
                            </div>
                        </div>
                        <div class="product_read">
                            <a href="/product.php">Подробнее</a>
                        </div>
                    </div>
                    <div class="product item">
                        <div class="sale">
                            <p>-10%</p>
                        </div>
                        <div class="product_img">
                            <img src="img/product.jpg" alt="">
                        </div>
                        <div class="product_name">
                            Кресло «Бюджет»
                        </div>
                        <div class="product_description">
                            Цвета: коричневый, чёрный, белый
                        </div>
                        <div class="product_price flex">
                            <div class="price_1">
                                <p>4 250 ₽</p>
                            </div>
                            <div class="price_2">
                                <p>5 130 ₽</p>
                            </div>
                        </div>
                        <div class="product_read">
                            <a href="/product.php">Подробнее</a>
                        </div>
                    </div>
                    <div class="product item product_border">
                        <div class="sale">
                            <p>-10%</p>
                        </div>
                        <div class="product_img">
                            <img src="img/product.jpg" alt="">
                        </div>
                        <div class="product_name">
                            Кресло «Бюджет»
                        </div>
                        <div class="product_description">
                            Цвета: коричневый, чёрный, белый
                        </div>
                        <div class="product_price flex">
                            <div class="price_1">
                                <p>4 250 ₽</p>
                            </div>
                            <div class="price_2">
                                <p>5 130 ₽</p>
                            </div>
                        </div>
                        <div class="product_read">
                            <a href="/product.php">Подробнее</a>
                        </div>
                    </div>
                    <div class="product item">
                        <div class="sale">
                            <p>-10%</p>
                        </div>
                        <div class="product_img">
                            <img src="img/product.jpg" alt="">
                        </div>
                        <div class="product_name">
                            Кресло «Бюджет»
                        </div>
                        <div class="product_description">
                            Цвета: коричневый, чёрный, белый
                        </div>
                        <div class="product_price flex">
                            <div class="price_1">
                                <p>4 250 ₽</p>
                            </div>
                            <div class="price_2">
                                <p>5 130 ₽</p>
                            </div>
                        </div>
                        <div class="product_read">
                            <a href="/product.php">Подробнее</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
        
        $('.minus').click(function () {
                var $input = $(this).parent().find('input');
                var count = parseInt($input.val()) - 1;
                count = count < 1 ? 1 : count;
                $input.val(count);
                $input.change();
                return false;
            });
            $('.plus').click(function () {
                var $input = $(this).parent().find('input');
                $input.val(parseInt($input.val()) + 1);
                $input.change();
                return false;
            });
            
        $('selector').selectbox();
    });

JS;

    $this->registerJs($js, $position = yii\web\View::POS_END, $key = null);
    $this->registerJsFile('public/js/xzoom.min.js');
    $this->registerJsFile('public/js/setup.js');
?>

