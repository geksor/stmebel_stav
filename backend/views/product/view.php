<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use backend\widgets\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $searchModel common\models\RecommendedProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <div class="box box-primary">
        <div class="box-header with-border">
            <p>
                <?= Html::a('<i class="fa fa-reply" aria-hidden="true"></i>', ['index'], ['class' => 'btn btn-default']) ?>
                <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Удалить товар?',
                        'method' => 'post',
                    ],
                ]) ?>
                <?= Html::a('Создать товар', ['create'], ['class' => 'btn btn-success']) ?>
                <?= Html::a('Изображения', ['/product-images', 'par_id' => $model->id], ['class' => 'btn btn-default']) ?>
                <?= Html::a('Категории', ['categories', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
                <?= Html::a('Атрибуты', ['/product-attr', 'par_id' => $model->id], ['class' => 'btn btn-default']) ?>
                <?= Html::a('Характеристики', ['/product-options', 'par_id' => $model->id], ['class' => 'btn btn-default']) ?>
                <?= Html::a('Рекомендуемые товары', ['recomm-view', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
            </p>
        </div>

        <div class="box-body">


            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    [
                        'attribute' => 'publish',
                        'label' => 'Состояние',
                        'value' => function ($data){
                            /* @var $data \common\models\Product */
                            if ($data->publish){
                                return 'Опубликован';
                            }
                            return 'Не опубликован';
                        }
                    ],
                    'title',
                    'alias',
                    'code',
                    'short_description:html',
                    'description:html',
                    'price:decimal',
                    'sale:decimal',
                    'hot:boolean',
                    'new:boolean',
                    'avail:boolean',
                    'unlimited:boolean',
                    'count:decimal',
                    'rank',

                ],
            ]) ?>
        </div>
    </div>


</div>
