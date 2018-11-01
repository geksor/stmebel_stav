<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AttrColor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="attr-color-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'color')->input('color', ['style' => 'width:50px;height:40px;']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохраниеть', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
