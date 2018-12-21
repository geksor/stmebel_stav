<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProductAttr */
/* @var $attrValue */

$this->title = 'Создание';
$this->params['breadcrumbs'][] = ['label' => 'Product Attrs', 'url' => ['index', 'par_id' => $model->product_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-attr-create">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
                'attrValue' => $attrValue,
            ]) ?>

        </div>
    </div>

</div>
