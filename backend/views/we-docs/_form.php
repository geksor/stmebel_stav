<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\WeDocs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="we-docs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'docNameView')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'itemDescription')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
