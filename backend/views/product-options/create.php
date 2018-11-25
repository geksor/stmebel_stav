<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProductOptions */

$this->title = 'Create Product Options';
$this->params['breadcrumbs'][] = ['label' => 'Product Options', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-options-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
