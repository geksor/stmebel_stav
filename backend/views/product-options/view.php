<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ProductOptions */

$this->title = $model->product_id;
$this->params['breadcrumbs'][] = ['label' => 'Характеристики товара', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-options-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'product_id' => $model->product_id, 'options_id' => $model->options_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'product_id' => $model->product_id, 'options_id' => $model->options_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Продолжить удаление?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'product_id',
            'options_id',
            'optionsValue_id',
            'options_value',
        ],
    ]) ?>

</div>
