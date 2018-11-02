<?php

use yii\helpers\Html;
use backend\widgets\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\HowWeWorkStepSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $par_id */

$this->title = 'Как мы работаем шаги';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="how-we-work-step-index">

    <div class="box box-primary">
        <div class="box-body">
            <?php Pjax::begin(); ?>

            <p>
                <?= Html::a('<i class="fa fa-reply" aria-hidden="true"></i>', ['how-we-work/view', 'id' => $par_id], ['class' => 'btn btn-default']) ?>
                <?= Html::a('Создать шаг', ['create', 'par_id' => $par_id], ['class' => 'btn btn-success']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
//                    'houWeWork_id',
                    'title',
//                    'description:ntext',
                    'rank',
                    [
                        'attribute' => 'publish',
                        'label' => 'Состояние',
                        'filter'=>[''=>'Все',0=>"Не опубликованные",1=>"Опубликованные"],
                        'headerOptions' => ['width' => '170'],
                        'format' => 'raw',
                        'value' => function ($data){
                            /* @var $data \common\models\HowWeWorkStep */
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
