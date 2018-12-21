<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use backend\widgets\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\OrderOptRbSec */
/* @var $searchModel common\models\OrderOptRbItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Выбор из нескольких', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-opt-rb-sec-view">

    <div class="box box-primary">
        <div class="box-body">

            <p>
                <?= Html::a('<i class="fa fa-reply" aria-hidden="true"></i>', ['index'], ['class' => 'btn btn-default']) ?>
                <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Продолжить удаление?',
                        'method' => 'post',
                    ],
                ]) ?>
                <?= Html::a('Создать новый раздел', ['create'], ['class' => 'btn btn-warning']) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'title',
                    'rank',
                ],
            ]) ?>

        </div>
    </div>

    <h2>Варианты выбора</h2>

    <div class="box box-primary">
        <div class="box-body">
            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <p>
                <?= Html::a('Создать вариант', ['create-item', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'title',
                    'addPrice',
                    [
                        'attribute' => 'rank',
                        'format' => 'raw',
                        'value' => function ($data){
                            /* @var $data \common\models\Product */
                            return Html::input('number', 'rank' ,$data->rank, ['class' => 'form-control', 'id' => $data->id]);
                        }

                    ],

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{update} {delete}',
                        'buttons' => [
                            'update' => function($url, $model, $key){
                                $icon = Html::tag('span', '', ['class' => "glyphicon glyphicon-pencil"]);
                                return Html::a($icon, 'update-item/'.$key);
                            },
                            'delete' => function($url, $model, $key){
                                $icon = Html::tag('span', '', ['class' => "glyphicon glyphicon-trash"]);
                                return Html::a($icon, 'delete-item/'.$key);
                            },
                        ],
                    ],
                ],
            ]); ?>
<?
$js = <<< JS
    $('[name = rank]').keypress(function(e){
        if(e.keyCode==13){
            $.ajax({
                type: "GET",
                url: "/admin/order-opt-rb-sec/rank-item",
                data: 'id='+ $(this).attr('id') +'&rank='+ $(this).val(),
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
