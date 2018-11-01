<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $selectedAttr common\models\Product */
/* @var $attributes */
/* @var $attrSet \backend\models\AttrProdSettings*/

$this->title = 'Настройка атрибутов: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Настройка атрибутов';
?>
<div class="product-atribute">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form-attr', [
                'attrSet' => $attrSet,
                'attributes' => $attributes,
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
