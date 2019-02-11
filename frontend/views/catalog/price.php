<?php

/* @var $this \frontend\components\View */

/* @var $model \common\models\Product */

?>

<? if ($model->sale) {?>
    <p class="product_right_price_1 main-price" data-price="<?= $model->getSaleCalcPrice($model->productAttrs) ?>" ><?= $model->getSaleCalcPrice($model->productAttrs, true) ?> <i class="fas fa-ruble-sign"></i></p>
    <p class="product_right_price_2"><?= $model->getCalcPrice($model->productAttrs, true) ?> <i class="fas fa-ruble-sign"></i></p>
<?}else{?>
    <p class="product_right_price_1 main-price" data-price="<?= $model->getCalcPrice($model->productAttrs) ?>"><?= $model->getCalcPrice($model->productAttrs, true) ?> <i class="fas fa-ruble-sign"></i></p>
<?}?>

