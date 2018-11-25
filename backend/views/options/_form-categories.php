<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Attr */
/* @var $form yii\widgets\ActiveForm */
/* @var $attributes */
?>

<div class="attr-categories-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'categoryType_id')->textInput() ?>

    <?= $form->field($model, 'optCat')->dropDownList($model::getCatFromDropDown(), [
        'multiple' => true,
        'size' => 15,
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
