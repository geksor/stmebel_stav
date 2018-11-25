<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProductOptions */

$this->title = 'Update Product Options: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Product Options', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->product_id, 'url' => ['view', 'product_id' => $model->product_id, 'options_id' => $model->options_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-options-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
