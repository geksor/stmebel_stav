<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $attrSet \backend\models\AttrProdSettings*/
/* @var $form yii\widgets\ActiveForm */
/* @var $attributes */
/* @var $model common\models\Product */
?>

<div class="product-form-attr">

    <? if (!empty($attributes)) {?>

        <?php $form = ActiveForm::begin(); ?>

        <? foreach ($attributes as $attribute) {/* @var $attribute \common\models\Attributes */?>

            <? if ($attribute->type === 1) {?>

                <?= $form->field($attrSet, 'attrString')
                ->textInput([
                    'name' => "attrString[$attribute->id]",
                    'value' => $attribute->getValueFromDropDown($model->id, 'attrString'),
                    'placeholder' => 'Введите значение',
                ])
                ->label($attribute->title) ?>

            <?}?>
            <? if ($attribute->type === 2) {?>

                <?= $form->field($attrSet, 'attrList')
                ->dropDownList($attribute->getListDropDown() ,[
                    'name' => "attrList[$attribute->id]",
                    'prompt' => 'Не выбран',
                    'options' => [
                        $attribute->getValueFromDropDown($model->id, 'attrList_id') => ['Selected' => true]
                    ],
                ])
                ->label($attribute->title) ?>

            <?}?>
            <? if ($attribute->type === 3) {?>

<!--                --><?// \yii\helpers\VarDumper::dump($attribute->getValueFromDropDown($model->id, 'attrColor_id', true),20,true);die; ?>

                <?= $form->field($attrSet, 'attrColor')
                ->dropDownList($attribute->getColorsDropDown() ,[
                    'name' => "attrColor[$attribute->id]",
                    'multiple' => true,
                    'size' => 15,
                    'options' => $attribute->getValueFromDropDown($model->id, 'attrColor_id', true),
                ])
                ->label($attribute->title) ?>

            <?}?>
        <?}?>

        <?= $form->field($attrSet, 'viewAttr')->dropDownList($model->getCatAttributes(true), [
            'multiple' => true,
            'size' => 15,
        ])->label('Показвать в превью товара') ?>

        <?= $form->field($attrSet, 'viewOnWidget')->dropDownList($model->getCatAttributes(true), [
            'multiple' => true,
            'size' => 15,
        ])->label('Показвать в Виджете') ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    <?}else{?>
        <p>Нет атрибутов</p>
    <?}?>

</div>
