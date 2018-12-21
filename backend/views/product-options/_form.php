<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\ProductOptions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-options-form">
    <? Pjax::begin(['id' => 'new_opt']); ?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'options_id')->dropDownList($model::getOptionsFromDropDown($model->product_id), ['prompt' => 'Выбрать значение', 'data-par_id' => $model->product_id]) ?>

    <? if ($model->options_id) {?>
        <? if ($model->is_list) {?>
            <?= $form->field($model, 'optionsValue_id')->dropDownList($model::getOptionsValueFromDropDown($model->options_id), ['prompt' => 'Выбрать значение']) ?>
        <?}else{?>
            <?= $form->field($model, 'options_value')->textInput(['maxlength' => true]) ?>
        <?}?>
    <?}?>

    <div class="form-group">
        <?= Html::submitButton('Создать', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?
    $js = <<< JS
    $('#productoptions-options_id').change(function(e){
            $.ajax({
                type: "GET",
                url: "/admin/product-options",
                data: 'par_id='+ $(this).attr('data-par_id') +'&opt_id='+ $(this).val()+'&ajax=true',
            })
    });
    $("document").ready(function(){
            $("#new_opt").on("pjax:end", function() {
            $.pjax.reload({container:"#options"});  //Reload GridView
        });
    });
JS;

    $this->registerJs($js, $position = yii\web\View::POS_END, $key = null);
    ?>
    <? Pjax::end() ?>

</div>
