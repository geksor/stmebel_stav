<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProductAttrSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-attr-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'product_id') ?>

    <?= $form->field($model, 'attr_id') ?>

    <?= $form->field($model, 'attrValue_id') ?>

    <?= $form->field($model, 'price_mod') ?>

    <?= $form->field($model, 'add_price') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
