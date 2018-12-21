<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use backend\widgets\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProductAttrSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Настройка атрибутов: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Настройка атрибутов';
?>
<div class="product-atribute">

    <div class="box box-primary">
        <div class="box-body">

            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <p>
                <?= Html::a('Создать атрибут', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'attribute' => 'attr_id',
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

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>

            <?php Pjax::end(); ?>
        </div>
    </div>

</div>
