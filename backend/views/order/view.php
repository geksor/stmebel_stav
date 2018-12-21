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
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$css = <<<CSS
    .colorBox{
        width: 100%;
        padding: 5px;
        display: flex;
        justify-content: center;
    }
    .colorBox__content{
        background-color: #ffffff;
        padding: 2px 4px;
    }
CSS;


$this->registerCss($css, ["type" => "text/css"], "orderView" );
?>
<div class="order-view">

    <div class="box box-primary">
        <div class="box-body">

            <p>
                <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Продолжить удаление?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'create_at:datetime',
                    [
                        'attribute' => 'checked_opt',
                        'format' => 'html',
                        'value' => function ($data){
                            /* @var $data \common\models\Order */
                            $value = '';
                            foreach (\yii\helpers\Json::decode($data->checked_opt) as $item){
                                $value .= $item.'<br>';
                            }
                            return $value;
                        }
                    ],
                    'customer_name',
                    'customer_phone',
                    'customer_email:email',
                    'total_price:integer',
//                    'state',
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
                    [
                        'attribute' => 'attr',
                        'format' => 'html',
                        'value' => function ($data){
                            /* @var $data \common\models\OrderItem */
                            $value = '';
                            foreach (\yii\helpers\Json::decode($data->attr) as $item){
                                $value .= $item.', ';
                            }
                            return $value;
                        }
                    ],

                    [
                        'attribute' => 'color',
                        'format' => 'html',
                        'value' => function ($data){
                            /* @var $data \common\models\OrderItem */
                            if ($data->color){
                                $content = Html::tag('span', $data->color, ['class' => 'colorBox__content']);
                                return Html::tag('div', $content, ['class' => 'colorBox', 'style' => "background-color:$data->color"]);
                            }
                            return 'Не выбран';
                        }
                    ],
                    'count',
                    'price:integer',

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
