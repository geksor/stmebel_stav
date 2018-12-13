<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use backend\widgets\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Order */
/* @var $searchModel common\models\OrderItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказ №'.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">

    <div class="box box-primary">
        <div class="box-body">

            <p>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'create_at',
                    'checked_opt:ntext',
                    'customer_name',
                    'customer_phone',
                    'customer_email:email',
                    'total_price',
                    'state',
                ],
            ]) ?>

        </div>
    </div>

    <h2>Позиции заказа</h2>

    <div class="box box-primary">
        <div class="box-body">
            <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'title',
                    'attr:ntext',
                    'color',
                    'count',
                    'price',

//                    [
//                        'class' => 'yii\grid\ActionColumn',
//                        'template' => '{delete}',
//                        'buttons' => [
//                            'delete' => function($url, $model, $key){
//                                $icon = Html::tag('span', '', ['class' => "glyphicon glyphicon-trash"]);
//                                return Html::a($icon, 'delete-item/'.$key);
//                            },
//                        ],
//
//                    ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>

</div>
