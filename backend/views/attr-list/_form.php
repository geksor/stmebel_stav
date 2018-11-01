<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AttrList */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="attr-list-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'attr_id')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
