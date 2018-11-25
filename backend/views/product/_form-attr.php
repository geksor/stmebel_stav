<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $models common\models\ProductAttr */
?>

<div class="product-form-attr">

    <? if (!empty($attributes)) {?>

        <?php $form = ActiveForm::begin(); ?>

        <? foreach ($models as $model) {/* @var $attribute \common\models\Attributes */?>

                <?= $form->field($attrSet, 'attrString')
                ->textInput([
                    'name' => "attrString[$attribute->id]",
                    'value' => $attribute->getValueFromDropDown($model->id, 'attrString'),
                    'placeholder' => 'Введите значение',
                ])
                ->label($attribute->title) ?>
                <?= $form->field($attrSet, 'attrRank')
                    ->textInput([
                        'name' => "attrRank[$attribute->id]",
                        'value' => $attribute->getValueFromDropDown($model->id, 'rank'),
                        'placeholder' => 'Порядок вывода',
                    ])
                    ->label(false)
                ?>
        <?}?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    <?}else{?>
        <p>Нет атрибутов</p>
    <?}?>

</div>
