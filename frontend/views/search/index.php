<?php

/* @var $this \frontend\components\View */

/* @var $products \common\models\Product */
/* @var $searchModel \frontend\models\SiteSearch */
/* @var $siteSettings \common\models\SiteSettings */

$this->registerMetaTag([
    'name' => 'title',
    'content' => $siteSettings->meta_title,
]);
$this->registerMetaTag([
    'name' => 'description',
    'content' => $siteSettings->meta_description,
]);


$addTitle = $searchModel->title?' по запросу: '.$searchModel->title:'';

$this->title = 'Результаты поиска'.$addTitle;
$this->params['breadcrumbs'][] = 'Результаты поиска';

?>
<div class="right_content flex">
    <div class="right_content_head flex">
        <h1><?= $this->title ?><br><?= $searchModel->filterCat?'в категории: '.$searchModel->filterCatTitle:'' ?></h1>
        <div class="sorting flex">
            <p>Сортировать по цене</p>
            <div class="sorting_img flex">
                <a href="<?= \yii\helpers\Url::to(['index', 'sort' => 'price']) ?>">
                    <img src="/public/img/up.svg" alt="по убыванию">
                </a>
                <a href="<?= \yii\helpers\Url::to(['index', 'sort' => '-price']) ?>">
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
                        <a href="<?= \yii\helpers\Url::to(['/catalog/item', 'alias' => $product->mainCat->alias, 'item' => $product->alias]) ?>"><img src="<?= $product->getThumbMainImage() ?>" alt="<?= $product->title ?>"></a>
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
                        <?= \yii\helpers\Html::a('Подробнее',['/catalog/item', 'alias' => $product->mainCat->alias, 'item' => $product->alias]) ?>
                    </div>
                </div>
            <?}?>
        <?}else{?>
            <h2>По вашему запросу ничего не найдено</h2>
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

