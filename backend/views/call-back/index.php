<?php

use yii\helpers\Html;
use backend\widgets\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\CallBackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Обратная связь';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="call-back-index">

    <div class="box box-primary">
        <div class="box-body">
            <?php Pjax::begin(); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'rowOptions' => function($model, $key, $index, $grid){
                    if(!$model->viewed){
                        return ['class' => 'newRow'];
                    }
                    if ($model->viewed === 2){
                        return ['class' => 'noReadRow'];
                    }
                    return null;
                },
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

//                    'id',
                    'name',
                    'phone',
                    [
                        'attribute' => 'created_at',
                        'headerOptions' => ['width' => '150'],
                        'format' => ['date', 'php:d.m.Y - H:i:s'],
                    ],
                    [
                        'attribute' => 'done_at',
                        'headerOptions' => ['width' => '150'],
                        'format' => ['date', 'php:d.m.Y - H:i:s'],
                    ],
                    [
                        'attribute' => 'viewed',
                        'label' => 'Состояние',
                        'filter'=>[0=>"Не обработанные",1=>"Обработанные"],
                        'headerOptions' => ['width' => '170'],
                        'format' => 'raw',
                        'value' => function ($data){
                            if (!$data->viewed){
                                return Html::a('Обработать',
                                    ['success', 'id' => $data->id, 'success' => true],
                                    ['class' => 'btn btn-success col-xs-12']);
                            }
                            return 'Обработано';
                        }
                    ],

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view}'
                    ],
                ],
            ]); ?>

            <?php Pjax::end(); ?>
        </div>
    </div>

</div>
