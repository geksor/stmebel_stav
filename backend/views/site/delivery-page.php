<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model \common\models\DeliveryPage */

$this->title = 'Страница доставка';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-params">

    <div class="box box-primary">
        <div class="box-body">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'title') ?>

            <?= $form->field($model, 'meta_title') ?>

            <?= $form->field($model, 'meta_description') ?>

            <?= $form->field($model, 'pageCode')->textarea(['rows' => 20]) ?>


            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

</div>
