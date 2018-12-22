<?

/* @var $items \frontend\widgets\HeaderMenuWidget */
/* @var $modelsHot \common\models\Product */
/* @var $modelsNew \common\models\Product */
/* @var $modelsSale \common\models\Product */

?>

<div class="products cont">
    <div id="tabs">
        <ul>
            <? if ($modelsHot) {?>
                <li><a href="#tabs-1">ХИТЫ ПРОДАЖ</a></li>
            <?}?>
            <? if ($modelsNew) {?>
                <li><a href="#tabs-2">НОВИНКИ</a></li>
            <?}?>
            <? if ($modelsSale) {?>
                <li><a href="#tabs-3">СКИДКИ</a></li>
            <?}?>
        </ul>
        <? if ($modelsHot) {?>
            <div id="tabs-1">
                <div class="slider1 owl-carousel owl-theme flex">
                    <? foreach ($modelsHot as $model) {/* @var $model \common\models\Product */?>
                        <div class="product item carusel">
                            <? if ($model->sale) {?>
                                <div class="sale">
                                    <p>-<?= $model->sale ?>%</p>
                                </div>
                            <?}?>
                            <? if ($model->hot) {?>
                                <div class="sale hot">
                                    <p>Хит продаж</p>
                                </div>
                            <?}?>
                            <? if ($model->new) {?>
                                <div class="sale new">
                                    <p>Новинка</p>
                                </div>
                            <?}?>
                            <div class="product_img">
                                <a href="<?= \yii\helpers\Url::to(['catalog/item', 'alias' => $model->mainCat->alias, 'item' => $model->alias]) ?>"><img src="<?= $model->getThumbMainImage() ?>" alt="<?= $model->title ?>"></a>
                            </div>
                            <div class="product_name">
                                <?= $model->title ?>
                            </div>
                            <div class="product_description">
                                <? if ($model->productOptionsList) {?>
                                    <? foreach ($model->productOptionsList as $productOption) {/* @var $productOption \common\models\ProductOptions */?>
                                        <?= $productOption->options->title ?>: <?= $productOption->options_value?$productOption->options_value:$productOption->optionsValue->value ?>
                                    <?}?>
                                <?}?>
                            </div>
                            <div class="product_price flex">
                                <? if ($model->sale) {?>
                                    <div class="price_1">
                                        <p><?= $model->getSaleAttrPrice(true) ?> <i class="fas fa-ruble-sign"></i></p>
                                    </div>
                                    <div class="price_2">
                                        <p><?= $model->getAttrPrice(true) ?> <i class="fas fa-ruble-sign"></i></p>
                                    </div>
                                <?}else{?>
                                    <div class="price_1">
                                        <p><?= $model->getAttrPrice(true) ?> <i class="fas fa-ruble-sign"></i></p>
                                    </div>
                                <?}?>
                            </div>
                            <div class="product_read">
                                <a href="/catalog/<?= $model->mainCat->alias ?>/<?= $model->alias ?>">Подобнее</a>
                            </div>
                        </div>
                    <?}?>
                </div>
            </div>
        <?}?>
        <? if ($modelsNew) {?>
            <div id="tabs-2">
                <div class="slider1 owl-carousel owl-theme flex">
                    <? foreach ($modelsNew as $model) {/* @var $model \common\models\Product */?>
                        <div class="product item carusel">
                            <? if ($model->sale) {?>
                                <div class="sale">
                                    <p>-<?= $model->sale ?>%</p>
                                </div>
                            <?}?>
                            <? if ($model->hot) {?>
                                <div class="sale hot">
                                    <p>Хит продаж</p>
                                </div>
                            <?}?>
                            <? if ($model->new) {?>
                                <div class="sale new">
                                    <p>Новинка</p>
                                </div>
                            <?}?>
                            <div class="product_img">
                                <img src="<?= $model->getThumbMainImage() ?>" alt="<?= $model->title ?>">
                            </div>
                            <div class="product_name">
                                <?= $model->title ?>
                            </div>
                            <div class="product_description">
                                <? if ($model->productOptionsList) {?>
                                    <? foreach ($model->productOptionsList as $productOption) {/* @var $productOption \common\models\ProductOptions */?>
                                        <?= $productOption->options->title ?>: <?= $productOption->options_value?$productOption->options_value:$productOption->optionsValue->value ?>
                                    <?}?>
                                <?}?>
                            </div>
                            <div class="product_price flex">
                                <? if ($model->sale) {?>
                                    <div class="price_1">
                                        <p><?= $model->getSaleAttrPrice(true) ?> <i class="fas fa-ruble-sign"></i></p>
                                    </div>
                                    <div class="price_2">
                                        <p><?= $model->getAttrPrice(true) ?> <i class="fas fa-ruble-sign"></i></p>
                                    </div>
                                <?}else{?>
                                    <div class="price_1">
                                        <p><?= $model->getAttrPrice(true) ?> <i class="fas fa-ruble-sign"></i></p>
                                    </div>
                                <?}?>
                            </div>
                            <div class="product_read">
                                <a href="/catalog/<?= $model->mainCat->alias ?>/<?= $model->alias ?>">Подробнее</a>
                            </div>
                        </div>
                    <?}?>
                </div>
            </div>
        <?}?>
        <? if ($modelsSale) {?>
            <div id="tabs-3">
                <div class="slider1 owl-carousel owl-theme flex">
                    <? foreach ($modelsSale as $model) {/* @var $model \common\models\Product */?>
                        <div class="product item carusel">
                            <? if ($model->sale) {?>
                                <div class="sale">
                                    <p>-<?= $model->sale ?>%</p>
                                </div>
                            <?}?>
                            <? if ($model->hot) {?>
                                <div class="sale hot">
                                    <p>Хит продаж</p>
                                </div>
                            <?}?>
                            <? if ($model->new) {?>
                                <div class="sale new">
                                    <p>Новинка</p>
                                </div>
                            <?}?>
                            <div class="product_img">
                                <img src="<?= $model->getThumbMainImage() ?>" alt="<?= $model->title ?>">
                            </div>
                            <div class="product_name">
                                <?= $model->title ?>
                            </div>
                            <div class="product_description">
                                <? if ($model->productOptionsList) {?>
                                    <? foreach ($model->productOptionsList as $productOption) {/* @var $productOption \common\models\ProductOptions */?>
                                        <?= $productOption->options->title ?>: <?= $productOption->options_value?$productOption->options_value:$productOption->optionsValue->value ?>
                                    <?}?>
                                <?}?>
                            </div>
                            <div class="product_price flex">
                                <? if ($model->sale) {?>
                                    <div class="price_1">
                                        <p><?= $model->getSaleAttrPrice(true) ?> <i class="fas fa-ruble-sign"></i></p>
                                    </div>
                                    <div class="price_2">
                                        <p><?= $model->getAttrPrice(true) ?> <i class="fas fa-ruble-sign"></i></p>
                                    </div>
                                <?}else{?>
                                    <div class="price_1">
                                        <p><?= $model->getAttrPrice(true) ?> <i class="fas fa-ruble-sign"></i></p>
                                    </div>
                                <?}?>
                            </div>
                            <div class="product_read">
                                <a href="/catalog/<?= $model->mainCat->alias ?>/<?= $model->alias ?>">Подробнее</a>
                            </div>
                        </div>
                    <?}?>
                </div>
            </div>
        <?}?>
    </div>
</div>

