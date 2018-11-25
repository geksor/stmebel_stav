<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\ProductAttr */
/* @var $form yii\widgets\ActiveForm */
/* @var $attrValue */
?>
<div class="product-attr-form">
    <? Pjax::begin(['id' => 'new_attr']); ?>

    <?php $form = ActiveForm::begin([
        'options' => [
            'data-pjax' => true
        ],
    ]); ?>
    <?= $form->field($model, 'attr_id')->dropDownList($model::getAttrFromDropDown($model->product_id), ['prompt' => 'Выбрать значение', 'data-par_id' => $model->product_id]) ?>

    <?= $form->field($model, 'attrValue_id')->dropDownList($attrValue, ['prompt' => 'Выбрать значение']) ?>

    <?= $form->field($model, 'price_mod')->dropDownList([0 => '+', 1 => '-', 2 => '*', 3 => '/', 4 => '=']) ?>

    <?= $form->field($model, 'add_price')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Создать', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?
    $js = <<< JS
    $('#productattr-attr_id').change(function(e){
            $.ajax({
                type: "GET",
                url: "/admin/product-attr",
                data: 'par_id='+ $(this).attr('data-par_id') +'&attr_id='+ $(this).val()+'&ajax=true',
            })
    });
    $("document").ready(function(){
            $("#new_attr").on("pjax:end", function() {
            $.pjax.reload({container:"#attrs"});  //Reload GridView
        });
    });
JS;

    $this->registerJs($js, $position = yii\web\View::POS_END, $key = null);
    ?>
    <? Pjax::end() ?>


</div>

