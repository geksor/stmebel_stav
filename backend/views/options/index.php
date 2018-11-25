<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\OptionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Options';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="options-index">

    <div class="box box-primary">
        <div class="box-body">
            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <p>
                <?= Html::a('Создать характеристику', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'title',
                    [
                        'attribute' => 'type',
                        'filter' => [0 => 'Строка', 1 => 'Список'],
                        'value' => function ($data){
                            /* @var $data \common\models\Options */
                            return $data->type?'Список':'Строка';
                        }
                    ],
                    'allCats:boolean',
                    [
                        'attribute' => 'rank',
                        'format' => 'raw',
                        'value' => function ($data){
                            /* @var $data \common\models\Options */
                            return Html::input('number', 'rank' ,$data->rank, ['class' => 'form-control', 'id' => $data->id]);
                        }

                    ],

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>

</div>
<?
$js = <<< JS
    $('[name = rank]').keypress(function(e){
        if(e.keyCode==13){
            $.ajax({
                type: "GET",
                url: "/admin/options/rank",
                data: 'id='+ $(this).attr('id') +'&rank='+ $(this).val(),
            })
        }
    });
JS;

$this->registerJs($js, $position = yii\web\View::POS_END, $key = null);
?>

