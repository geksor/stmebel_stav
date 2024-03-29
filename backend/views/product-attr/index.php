<?php

use yii\helpers\Html;
use backend\widgets\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ProductAttrSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $attrValue */

$this->title = 'Атрибуты товара';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-attr-index">

    <div class="box box-primary">
        <div class="box-body">
            <p>
                <?= Html::a('<i class="fa fa-reply" aria-hidden="true"></i>', ['product/view', 'id' => $searchModel->product_id], ['class' => 'btn btn-default']) ?>
            </p>

            <?= $this->render('_form', [
                'model' => $model,
                'attrValue' => $attrValue,
            ]) ?>

        </div>
    </div>
    <div class="box box-primary">
        <div class="box-body">

            <?php Pjax::begin(['id' => 'attrs']); ?>
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
                        'attribute' => 'attr_id',
                        'filter' => $searchModel::getAttrFromDropDown($searchModel->product_id),
                        'value' => function ($data){
                            /* @var $data \common\models\ProductAttr */
                            return $data->attr->title;
                        }
                    ],
                    [
                        'attribute' => 'attrValue_id',
                        'value' => function ($data){
                            /* @var $data \common\models\ProductAttr */
                            return $data->attrValue->value;
                        }
                    ],
                    [
                        'attribute' => 'price_mod',
                        'filter' => false,
                        'value' => function ($data){
                            /* @var $data \common\models\ProductAttr */
                            switch ($data->price_mod){
                                case 0:
                                    return '+';
                                case 1:
                                    return '-';
                                default:
                                    return null;
                            }
                        }
                    ],
                    'add_price:decimal',
                    [
                        'attribute' => 'rank',
                        'format' => 'raw',
                        'value' => function ($data){
                            /* @var $data \common\models\ProductAttr */
                            return Html::input(
                                    'number',
                                    'rank' ,$data->rank,
                                    [
                                        'class' => 'form-control',
                                        'id' => $data->product_id,
                                        'data-attr_id' => $data->attr_id,
                                        'data-attrValue_id' => $data->attrValue_id,
                                    ]);
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
    $('[name = rank]').keypress(function(e){
        if(e.keyCode==13){
            $.ajax({
                type: "GET",
                url: "/admin/product-attr/rank",
                data: 'product_id='+ $(this).attr('id') + '&attr_id=' + $(this).attr('data-attr_id') + '&attrValue_id=' + $(this).attr('data-attrValue_id')+'&rank=' + $(this).val(),
            })
        }
    });
JS;

$this->registerJs($js, $position = yii\web\View::POS_END, $key = null);
?>


            <?php Pjax::end(); ?>
        </div>
    </div>

</div>
