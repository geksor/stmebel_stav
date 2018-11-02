<?php

use yii\helpers\Html;
use backend\widgets\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\PersonalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Сотрудники';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personal-index">

    <div class="box box-primary">
        <div class="box-body">
            <?php Pjax::begin(); ?>

            <p>
                <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

//                    'id',
                    [
                        'attribute' => 'image',
                        'headerOptions' => ['width' => 100],
                        'filter' => false,
                        'format' => 'raw',
                        'value' => function ($data){
                            /* @var $data \common\models\Personal */
                            return Html::img($data->getPhotos('personal')['thumb_image'], ['style' => 'max-width: 100px;']);
                        }
                    ],
                    'name',
                    'position',
                    [
                        'attribute' => 'publish',
                        'label' => 'Состояние',
                        'filter'=>[''=>'Все',0=>"Не опубликованные",1=>"Опубликованные"],
                        'headerOptions' => ['width' => '170'],
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
