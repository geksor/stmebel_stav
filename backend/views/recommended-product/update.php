<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RecommendedProduct */

$this->title = 'Update Recommended Product: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Recommended Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->product_id, 'url' => ['view', 'product_id' => $model->product_id, 'recommProduct_id' => $model->recommProduct_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="recommended-product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
