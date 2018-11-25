<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'short_description') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'meta_title') ?>

    <?php // echo $form->field($model, 'meta_description') ?>

    <?php // echo $form->field($model, 'alias') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'code') ?>

    <?php // echo $form->field($model, 'avail') ?>

    <?php // echo $form->field($model, 'unlimited') ?>

    <?php // echo $form->field($model, 'count') ?>

    <?php // echo $form->field($model, 'sale') ?>

    <?php // echo $form->field($model, 'hot') ?>

    <?php // echo $form->field($model, 'new') ?>

    <?php // echo $form->field($model, 'rank') ?>

    <?php // echo $form->field($model, 'publish') ?>

    <?php // echo $form->field($model, 'rating') ?>

    <?php // echo $form->field($model, 'reviews_count') ?>

    <?php // echo $form->field($model, 'main_image') ?>

    <?php // echo $form->field($model, 'hits') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
