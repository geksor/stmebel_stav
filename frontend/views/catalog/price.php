<?php

/* @var $this \frontend\components\View */

/* @var $model \common\models\Product */

?>

<? if ($model->sale) {?>
    <p class="product_right_price_1 main-price" ><?= $model->getSaleCalcPrice($model->productAttrs, true) ?> Р</p>
    <p class="product_right_price_2"><?= $model->getCalcPrice($model->productAttrs, true) ?> Р</p>
<?}else{?>
    <p class="product_right_price_1 main-price" ><?= $model->getCalcPrice($model->productAttrs, true) ?> Р</p>
<?}?>

