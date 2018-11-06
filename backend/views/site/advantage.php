<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;


/* @var $this yii\web\View */
/* @var $model \backend\models\Advantage */

$this->title = 'Приемущества';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advantage-params">

    <div class="box box-primary">
        <div class="box-body">

            <?php $form = ActiveForm::begin(); ?>

            <h2>Блок 1</h2>
            <?= Html::a(
                'Выбрать изображение',
                [
                    'set-image',
                    'actionName' => 'advantage',
                    'width' => 50,
                    'height' => 50,
                    'oldImage' => $model->image1,
                    'blockNum' => 1,
                ],
                [
                    'class' => 'btn btn-default',
                    'style' => 'margin: 20px 0',
                ]) ?>

            <div class="imgBlock">
                <? if ($model->image1) {?>
                    <img src="/uploads/images/params/thumb_<?= $model->image1 ?>" alt="image" style="max-width: 100px">
            <?}else{?>
                    <img src="/no_image.png" alt="no-image" style="max-width: 100px">
            <?}?>
            </div>
            <?= $form->field($model, 'image1')->hiddenInput()->label(false) ?>
            <?= $form->field($model, 'text1') ?>

            <h2>Блок 2</h2>
            <?= Html::a(
                'Выбрать изображение',
                [
                    'set-image',
                    'actionName' => 'advantage',
                    'width' => 50,
                    'height' => 50,
                    'oldImage' => $model->image2,
                    'blockNum' => 2,
                ],
                [
                    'class' => 'btn btn-default',
                    'style' => 'margin: 20px 0',
                ]) ?>

            <div class="imgBlock">
                <? if ($model->image2) {?>
                    <img src="/uploads/images/params/thumb_<?= $model->image2 ?>" alt="image" style="max-width: 100px">
                <?}else{?>
                    <img src="/no_image.png" alt="no-image" style="max-width: 100px">
                <?}?>
            </div>
            <?= $form->field($model, 'image2')->hiddenInput()->label(false) ?>
            <?= $form->field($model, 'text2') ?>

            <h2>Блок 3</h2>
            <?= Html::a(
                'Выбрать изображение',
                [
                    'set-image',
                    'actionName' => 'advantage',
                    'width' => 50,
                    'height' => 50,
                    'oldImage' => $model->image3,
                    'blockNum' => 3,
                ],
                [
                    'class' => 'btn btn-default',
                    'style' => 'margin: 20px 0',
                ]) ?>

            <div class="imgBlock">
                <? if ($model->image3) {?>
                    <img src="/uploads/images/params/thumb_<?= $model->image3 ?>" alt="image" style="max-width: 100px">
                <?}else{?>
                    <img src="/no_image.png" alt="no-image" style="max-width: 100px">
                <?}?>
            </div>
            <?= $form->field($model, 'image3')->hiddenInput()->label(false) ?>
            <?= $form->field($model, 'text3') ?>

            <h2>Блок 4</h2>
            <?= Html::a(
                'Выбрать изображение',
                [
                    'set-image',
                    'actionName' => 'advantage',
                    'width' => 50,
                    'height' => 50,
                    'oldImage' => $model->image4,
                    'blockNum' => 4,
                ],
                [
                    'class' => 'btn btn-default',
                    'style' => 'margin: 20px 0',
                ]) ?>

            <div class="imgBlock">
                <? if ($model->image4) {?>
                    <img src="/uploads/images/params/thumb_<?= $model->image4 ?>" alt="image" style="max-width: 100px">
                <?}else{?>
                    <img src="/no_image.png" alt="no-image" style="max-width: 100px">
                <?}?>
            </div>
            <?= $form->field($model, 'image4')->hiddenInput()->label(false) ?>
            <?= $form->field($model, 'text4') ?>


            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

</div>
