<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ProductOptionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Options';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-options-index">

    <div class="box box-primary">
        <div class="box-body">
            <p>
                <?= Html::a('<i class="fa fa-reply" aria-hidden="true"></i>', ['product/view', 'id' => $searchModel->product_id], ['class' => 'btn btn-default']) ?>
            </p>

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

    <div class="box box-primary">
        <div class="box-body">

            <?php Pjax::begin(['id' => 'options']); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <p>
                <!--                --><?//= Html::a('Создать атрибут', ['create', 'par_id' => $searchModel->product_id], ['class' => 'btn btn-success']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'attribute' => 'options_id',
                        'filter' => $searchModel::getOptionsFromDropDown($searchModel->product_id),
                        'value' => function ($data){
                            /* @var $data \common\models\ProductOptions */
                            return $data->options->title;
                        }
                    ],
                    [
                        'label' => 'Значение',
                        'format' => 'raw',
                        'value' => function ($data){
                            /* @var $data \common\models\ProductOptions */
                            if ($data->optionsValue){
                                return Html::dropDownList(
                                    'optValueId',
                                    $data->optionsValue_id,
                                    $data::getOptionsValueFromDropDown($data->options_id),
                                    ['class' => 'form-control', 'id' => $data->product_id, 'data-opt_id' => $data->options_id]
                                );
                            }
                            if ($data->options_value){
                                return Html::input(
                                    'text',
                                    'optValue',
                                    $data->options_value,
                                    ['class' => 'form-control', 'id' => $data->product_id, 'data-opt_id' => $data->options_id]
                                );
                            }
                            return '';
                        }
                    ],

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{delete}'
                    ],
                ],
            ]); ?>
<?
$js = <<< JS
    $('[name = optValue]').keypress(function(e){
        if(e.keyCode==13){
            $.ajax({
                type: "GET",
                url: "/admin/product-options/value",
                data: 'product_id='+ $(this).attr('id') +'&options_id='+ $(this).attr('data-opt_id') +'&value='+ $(this).val(),
            })
        }
    });
    $('[name = optValueId]').change(function(e){
            $.ajax({
                type: "GET",
                url: "/admin/product-options/value-id",
                data: 'product_id='+ $(this).attr('id') +'&options_id='+ $(this).attr('data-opt_id') +'&value_id='+ $(this).val(),
            })
    });
JS;

$this->registerJs($js, $position = yii\web\View::POS_END, $key = null);
?>

            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
