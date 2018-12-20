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

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'title') ?>
            <?= $form->field($model, 'meta_title') ?>
            <?= $form->field($model, 'meta_description') ?>
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
