<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProductImages */

$this->title = 'Create Product Images';
$this->params['breadcrumbs'][] = ['label' => 'Product Images', 'url' => ['index', 'par_id' => $model->product_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-images-create">

    <div class="box box-primary">
        <div class="box-body">

            <p>
                <?= Html::a('<i class="fa fa-reply" aria-hidden="true"></i>', ['index', 'par_id' => $model->product_id], ['class' => 'btn btn-default']) ?>
            </p>

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
