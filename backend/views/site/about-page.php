<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;


/* @var $this yii\web\View */
/* @var $model \backend\models\AboutPage */

$this->title = 'Текст о нас на странице о нас';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="about-page-params">

    <div class="box box-primary">
        <div class="box-body">
            <?= Html::a(
                'Выбрать изображение',
                [
                    'set-image',
                    'actionName' => 'about-page',
                    'width' => 620,
                    'height' => 635,
                    'oldImage' => $model->image,
                ],
                [
                    'class' => 'btn btn-default',
                    'style' => 'margin: 20px 0',
                ]) ?>

            <div class="imgBlock">
                <? if ($model->image) {?>
                    <img src="/uploads/images/params/thumb_<?= $model->image ?>" alt="image" style="max-width: 400px">
                <?}else{?>
                    <img src="/no_image.png" alt="no-image" style="max-width: 400px">
                <?}?>
            </div>


            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'image')->hiddenInput()->label(false) ?>
            <?= $form->field($model, 'description')->widget(CKEditor::className(),[
                'editorOptions' => [
                    'preset' => 'basic', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                    'inline' => false, //по умолчанию false
                    'height' => 400,
                    'resize_enabled' => true,
                ],
            ]); ?>

            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

</div>
