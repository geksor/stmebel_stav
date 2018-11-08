<?php

/* @var $this \frontend\components\View */
/* @var $model \common\models\Category */
/* @var $products \common\models\Product */
/* @var $pages \yii\data\Pagination */
/* @var $child \frontend\controllers\CatalogController */

$breadCrumb = '';
foreach ($model->child as $category) {
    if ($category->alias === $child) {
        $breadCrumb = $category->title;
        $this->registerMetaTag([
            'name' => 'title',
            'content' => $category->meta_title,
        ]);
        $this->registerMetaTag([
            'name' => 'description',
            'content' => $category->meta_description,
        ]);
    }
}
$this->headerClass = 'catalog-house';
$this->title = $model->title;
$this->params['breadcrumbs'][] = $breadCrumb;
//\yii\helpers\VarDumper::dump($model,10,true);die;
?>
<div id="catalog" class="container mw-1200 mt-5 pt-5">
    <div class="row justify-content-center justify-content-lg-between">
        <div class="col-12 col-lg-3">
            <div class="list-group">
                <? foreach ($model->child as $key => $category) {
                    /* @var $category \common\models\Category */ ?>
                    <?
                    $rounder = $key === 0 || $key === count($model->child) - 1 ? 'rounded-0' : '';
                    $active = $category->alias === $child ? 'active' : '';
                    ?>
                    <a href="/catalog/<?= $model->alias ?>/<?= $category->alias ?>"
                       class="list-group-item list-group-item-action <?= $active ?> <?= $rounder ?> text-center">
                        <?= $category->title ?>
                    </a>
                <? } ?>
            </div>
        </div>
        <div class="col-12 col-lg-9 mt-4 mt-lg-0">
            <div class="row justify-content-center justify-content-lg-end">
                <div class="col-12">
                    <div class="row">

                        <? if ($products != null) { ?>
                            <? foreach ($products as $product) {
                                /* @var $product \common\models\Product */ ?>
                                <div class="col-12 col-sm-6 col-lg-4 mb-4">
                                    <div class="card rounded-0" style="height: 100%">
                                        <?
                                        $imgSrc = '/no_image.png';
                                        if ($product->getBehavior('galleryBehavior')->getImages()) {
                                            foreach ($product->getBehavior('galleryBehavior')->getImages() as $key => $image) {
                                                /* @var $image \zxbodya\yii2\galleryManager\GalleryImage */
                                                if ($key === 0) {
                                                    $imgSrc = $image->getUrl('medium');
                                                }
                                            }
                                        }
                                        ?>
                                        <div class="card-img-top rounded-0"
                                             style="position: relative; padding-top: 66%">
                                            <?= \yii\helpers\Html::img($imgSrc, [
                                                'alt' => $product->title,
                                                'style' => 'position: absolute; height: 100%; width:100%; object-fit:cover;top:0;left:0;'
                                            ]) ?>
                                        </div>

                                        <div class="card-body d-flex flex-column justify-content-between">
                                            <h5 class="card-title"><?= $product->title ?></h5>
                                            <? foreach ($product->attributes0 as $key => $attr) {
                                                /* @var $attr \common\models\Attributes */ ?>
                                                <? if (in_array($attr->id, $product->getViewAttr())) {?>
                                                    <p class="card-text mb-0">
                                                        <small class="text-muted"><?= $attr->viewName ?>:</small>
                                                        <? if ($attr->type >= 1 && $attr->type < 3) { ?>
                                                            <?= $attr->getAttrValue($product->id) ?>
                                                        <? } else if ($attr->type === 3) { ?>
                                                            <?= $attr->getAttrValue($product->id)->title ?>
                                                        <? } ?>
                                                    </p>
                                                <?}?>
                                            <? } ?>
                                            <div class="text-center mt-3">
                                                <a class="btn btn-outline-primary my-2 my-sm-0 rounded-0"
                                                   href="/catalog/<?= $model->alias ?>/<?= $child ?>/<?= $product->alias ?>">
                                                    Подробнее
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            <? } ?>
                        <? } else { ?>
                            <h2 class="product__name">Категория не содержит товаров</h2>
                        <? } ?>

                    </div>


                    <div class="col-12 mt-4 pr-lg-0">
                        <nav aria-label="...">
                            <?= \yii\widgets\LinkPager::widget([
                                'pagination' => $pages,
                                'prevPageLabel' => false,
                                'nextPageLabel' => false,
                                'pageCssClass' => 'page-item',
                                'activePageCssClass' => 'active',
                                'options' => [
                                    'class' => 'pagination justify-content-center justify-content-lg-end'
                                ],
                                'linkOptions' => [
                                    'class' => 'page-link rounded-0',
                                ],
                                'maxButtonCount' => 4,
                            ]); ?>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
