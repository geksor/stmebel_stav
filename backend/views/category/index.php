<?php

use yii\helpers\Html;
use backend\widgets\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $filterArr */

$this->title = 'Категории';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <div class="box box-primary">
        <div class="box-body">
            <?php Pjax::begin(); ?>

            <p>
                <?= Html::a('Создать категорию', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'attribute' => 'id',
                        'headerOptions' => ['width' => 70],
                    ],
//                    'categoryType_id',
                    [
                        'attribute' => 'parent_id',
                        'filter'=> \common\models\Category::getParentsList(),
                        'filterInputOptions' => ['prompt' => 'Все', 'class' => 'form-control form-control-sm'],
                        'headerOptions' => ['width' => '170'],
                        'content'=>function($data){
                            /* @var $data \common\models\Category */
                            return $data->getParentName();
                        },
                    ],
                    [
                        'attribute' => 'title',
                        'content' => function($data){
                            /* @var $data \common\models\Category */
                            return "<strong> $data->title </strong>";
                        }
                    ],
                    'description:ntext',
                    //'alias',
                    //'meta_title',
                    //'meta_description',
                    [
                        'attribute' => 'rank',
                        'format' => 'raw',
                        'value' => function ($data){
                            /* @var $data \common\models\Category */
                            return Html::input('number', 'rank' ,$data->rank, ['class' => 'form-control', 'id' => $data->alias]);
                        }

                    ],
                    [
                        'attribute' => 'publish',
                        'label' => 'Состояние',
                        'filter'=>[0=>"Не опубликованные",1=>"Опубликованные"],
                        'filterInputOptions' => ['prompt' => 'Все', 'class' => 'form-control form-control-sm'],
                        'headerOptions' => ['width' => '170'],
                        'format' => 'raw',
                        'value' => function ($data){
                            /* @var $data \common\models\Category */
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
<?
$js = <<< JS
    $('[name = rank]').keypress(function(e){
        if(e.keyCode==13){
            $.ajax({
                type: "GET",
                url: "/admin/category/rank",
                data: 'alias='+ $(this).attr('id') +'&rank='+ $(this).val(),
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
