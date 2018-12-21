<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model \common\models\DeliveryPage */

$this->title = 'Три блока';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-params">

    <div class="box box-primary">
        <div class="box-body">

            <?php $form = ActiveForm::begin(); ?>

            <h2>Первый блок</h2>

            <?= $form->field($model, 'one_title') ?>

            <?= $form->field($model, 'one_image') ?>

            <?= $form->field($model, 'one_text')->textarea(['rows' => 20]) ?>

            <h2>Второй блок</h2>

            <?= $form->field($model, 'two_title') ?>

            <?= $form->field($model, 'two_image') ?>

            <?= $form->field($model, 'two_text')->textarea(['rows' => 20]) ?>

            <h2>Третий блок</h2>

            <?= $form->field($model, 'three_title') ?>

            <?= $form->field($model, 'three_image') ?>

            <?= $form->field($model, 'three_text')->textarea(['rows' => 20]) ?>



            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

</div>
