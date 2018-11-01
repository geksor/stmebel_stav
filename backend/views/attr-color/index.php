<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AttrColorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заполнение цвета';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attr-color-index">
    <style>
        .attrColor{
            width: 25px;
            height: 25px;
        }
    </style>

    <div class="box box-primary">
        <div class="box-body">
            <?php Pjax::begin(); ?>

            <p>
                <?= Html::a('<i class="fa fa-reply" aria-hidden="true"></i>', ['attributes/view', 'id' => $searchModel->attr_id], ['class' => 'btn btn-default']) ?>
                <?= Html::a('Создать', ['create', 'par_id' => $searchModel->attr_id], ['class' => 'btn btn-success']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
//                    'attr_id',
                    'title',
                    [
                        'attribute' => 'color',
                        'format' => 'raw',
                        'value' => function ($data){
                            /* @var $data \common\models\AttrColor */
                            return Html::tag('div', null, ['class' => 'attrColor', 'style' => "background-color: $data->color;"]);
                        }
                    ],

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
