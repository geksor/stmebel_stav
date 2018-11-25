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
                        'attribute' => 'product_id',
                        'filter' => $searchModel::getOptionsFromDropDown($searchModel->product_id),
                        'value' => function ($data){
                            /* @var $data \common\models\ProductOptions */
                            return $data->options->title;
                        }
                    ],
                    [
                        'attribute' => 'optionsValue_id',
                        'value' => function ($data){
                            /* @var $data \common\models\ProductOptions */
                            return $data->optionsValue->value;
                        }
                    ],
                    'options_value',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{delete}'
                    ],
                ],
            ]); ?>

            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
