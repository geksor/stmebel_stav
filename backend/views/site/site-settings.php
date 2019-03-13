<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model \common\models\SiteSettings */

$this->title = 'Общие настройки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-params">

    <div class="box box-primary">
        <div class="box-body">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'title_home') ?>

            <?= $form->field($model, 'meta_title') ?>

            <?= $form->field($model, 'meta_description') ?>

            <?= $form->field($model, 'slider')->dropDownList($model->getSliderFromDropDown()) ?>


            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

</div>
