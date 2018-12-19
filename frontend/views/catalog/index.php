<?php

/* @var $this \frontend\components\View */

use yii\helpers\ArrayHelper;

/* @var $model \common\models\Category */
/* @var $products \common\models\Product */
/* @var $pages \yii\data\Pagination */
/* @var $modelsFromLeft \common\models\Category */

if ($model){
    $this->title = $model->title;

    $this->registerMetaTag([
        'name' => 'title',
        'content' => $model->meta_title,
    ]);
    $this->registerMetaTag([
        'name' => 'description',
        'content' => $model->meta_description,
    ]);
}else{
    $this->title = 'Каталог мебели';
}

$breads = $model?$model->getParentsFromBread():false;
if ($model){
    $this->params['breadcrumbs'][] = ['label' => 'Каталог мебели', 'url' => ['/catalog']];
}

if ($breads){
    foreach ($breads as $bread){
        $this->params['breadcrumbs'][] = ['label' => $bread['title'], 'url' => ['index', 'alias' => $bread['alias']]];
    }
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="left_menu" id = "nav">
    <h2>Каталог мебели</h2>
    <?= \yii\widgets\Menu::widget([
        'items' => $items,
        'activateItems' => true,
        'activateParents' => true,
        'activeCssClass' => 'active',
        'labelTemplate' =>'{label} Label',
        'linkTemplate' => '<a href="{url}">{label}</a>',
        'submenuTemplate' => "\n<ul class='subs'>\n{items}\n</ul>\n",
    ]) ?>
</div>

<div class="right_content flex">
    <div class="right_content_head flex">
        <h1><?= $this->title ?></h1>
        <div class="sorting flex">
            <p>Сортировать по цене</p>
            <div class="sorting_img flex">
                <a href="<?= \yii\helpers\Url::to(['index', 'alias' => $model?$model->alias:null, 'orderPrice' => 1]) ?>">
                    <img src="/public/img/up.svg" alt="по убыванию">
                </a>
                <a href="<?= \yii\helpers\Url::to(['index', 'alias' => $model?$model->alias:null, 'orderPrice' => 2]) ?>">
                    <img src="/public/img/down.svg" alt="по возрастанию">
                </a>
            </div>
        </div>
    </div>
    <div class="flex_4">
        <? if ($products) {?>
            <? foreach ($products as $product) {/* @var $product \common\models\Product */?>
                <div class="product product_in">
                    <? if ($product->sale) {?>
                        <div class="sale">
                            <p>-<?= $product->sale ?>%</p>
                        </div>
                    <?}?>
                    <? if ($product->hot) {?>
                        <div class="sale hot">
                            <p>Хит продаж</p>
                        </div>
                    <?}?>
                    <? if ($product->new) {?>
                        <div class="sale new">
                            <p>Новинка</p>
                        </div>
                    <?}?>
                    <div class="product_img">
                        <? if ($model) {?>
                            <a href="<?= \yii\helpers\Url::to(['item', 'alias' => $model->alias, 'item' => $product->alias]) ?>"><img src="<?= $product->getThumbMainImage() ?>" alt="<?= $product->title ?>"></a>
                        <?}else{?>
                            <a href="<?= \yii\helpers\Url::to(['item', 'alias' => $product->mainCat->alias, 'item' => $product->alias]) ?>"><img src="<?= $product->getThumbMainImage() ?>" alt="<?= $product->title ?>"></a>
                        <?}?>
                    </div>
                    <div class="product_name">
                        <?= $product->title ?>
                    </div>
                    <div class="product_description">
                        <? if ($product->productOptionsList) {?>
                            <? foreach ($product->productOptionsList as $productOption) {/* @var $productOption \common\models\ProductOptions */?>
                                <?= $productOption->options->title ?>: <?= $productOption->options_value?$productOption->options_value:$productOption->optionsValue->value ?>
                            <?}?>
                        <?}?>
                    </div>
                    <div class="product_price flex">
                        <? if ($product->sale) {?>
                            <div class="price_1">
                                <p><?= $product->getSaleAttrPrice(true) ?> Р</p>
                            </div>
                            <div class="price_2">
                                <p><?= $product->getAttrPrice(true) ?> Р</p>
                            </div>
                        <?}else{?>
                            <div class="price_1">
                                <p><?= $product->getAttrPrice(true) ?> Р</p>
                            </div>
                        <?}?>
                    </div>
                    <div class="product_read">
                        <? if ($model) {?>
                            <?= \yii\helpers\Html::a('Подробнее',['item', 'alias' => $model->alias, 'item' => $product->alias]) ?>
                        <?}else{?>
                            <?= \yii\helpers\Html::a('Подробнее',['item', 'alias' => $product->mainCat->alias, 'item' => $product->alias]) ?>
                        <?}?>
                    </div>
                </div>
            <?}?>
        <?}else{?>
            <h2>Нет товаров</h2>
        <?}?>
    </div>
<!--    <div class="nav_number">-->
<!--        --><?//= \yii\widgets\LinkPager::widget([
//            'pagination' => $pages,
//            'prevPageLabel' => false,
//            'nextPageLabel' => false,
//            'pageCssClass' => 'page-item',
//            'activePageCssClass' => 'active',
//            'maxButtonCount' => 5,
//        ]); ?>
<!--    </div>-->
</div>

