<?php

use yii\helpers\Html;
use backend\widgets\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $categories array */

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <div class="box box-primary">
        <div class="box-body">

            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <p>
                <?= Html::a('Создать товар', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'attribute' => 'id',
                        'headerOptions' => ['width' => 50],
                    ],
                    [
                        'attribute' => 'filterCat',
                        'filter'=>$categories,
                        'filterInputOptions' => ['prompt' => 'Все', 'class' => 'form-control form-control-sm'],
                        'headerOptions' => ['width' => 170],
                        'value' => function ($data){
                            return '';
                        },
                    ],
                    'title',
                    [
                        'attribute' => 'short_description',
                        'format' => 'html'
                    ],
//                    'description:ntext',
                    [
                        'attribute' => 'rank',
                        'format' => 'raw',
                        'headerOptions' => ['width' => 50],
                        'filter' => false,
                        'value' => function ($data){
                            /* @var $data \common\models\Product */
                            $intDown = $data->rank > 1 ? 1 : 0;
                            $up = Html::a(
                                '&#9650;',
                                [
                                    'order',
                                    'id' => $data->id,
                                    'order' => $data->rank - $intDown,
                                    'up' => true,
                                ],
                                ['class'=>'btn btn-default']);

                            $down = Html::a(
                                '&#9660;',
                                [
                                    'order',
                                    'id' => $data->id,
                                    'order' => $data->rank + 1,
                                    'up' => false,
                                ],
                                ['class'=>'btn btn-default']);

                            if ($data->getMaxRank() === $data->rank){
                                return $up;
                            }
                            if ($data->getMinRank() === $data->rank){
                                return $down;
                            }
                            return $up.$down;
                        }
                    ],
                    [
                        'attribute' => 'publish',
                        'label' => 'Состояние',
                        'filter'=>[0=>"Не опубликованные",1=>"Опубликованные"],
                        'filterInputOptions' => ['prompt' => 'Все', 'class' => 'form-control form-control-sm'],
                        'headerOptions' => ['width' => 50],
                        'format' => 'raw',
                        'value' => function ($data){
                            /* @var $data \common\models\Comment */
                            if ($data->publish){
                                return Html::a('Снять с публикации',
                                    ['publish', 'id' => $data->id, 'publish' => false],
                                    ['class' => 'btn btn-default col-xs-12']);
                            }
                            return Html::a('Опубликовать',
                                ['publish', 'id' => $data->id, 'publish' => true],
                                ['class' => 'btn btn-success col-xs-12']);
                        }
                    ],

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
