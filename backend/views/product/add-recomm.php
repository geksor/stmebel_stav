<?php

use yii\helpers\Html;
use backend\widgets\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ProductSearchRecomm */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $fromId */

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <div class="box box-primary">
        <div class="box-body">

            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <p>
                <?= Html::a('<i class="fa fa-reply" aria-hidden="true"></i>', ['view', 'id' => $searchModel->fromId], ['class' => 'btn btn-default']) ?>
            </p>
            <?php Pjax::begin(); ?>
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
                        'filter'=> $searchModel::getCatFromDropDown(),
                        'filterInputOptions' => ['prompt' => 'Все', 'class' => 'form-control form-control-sm'],
                        'headerOptions' => ['width' => 170],
                        'value' => function ($data){
                            return '';
                        },
                    ],
                    [
                        'attribute' => 'main_image',
                        'filter' => false,
                        'enableSorting' => false,
                        'headerOptions' => ['width' => 50],
                        'format' => 'raw',
                        'value' => function ($data){
                            /* @var $data \common\models\Product */
                            return Html::img($data->getThumbMainImage(),['width' => 70]);
                        }
                    ],
                    'title',
                    [
                        'headerOptions' => ['width' => 50],
                        'format' => 'raw',
                        'value' => function ($data) use ($fromId){
                            /* @var $data \common\models\Product */
                            return Html::a('Выбрать',
                                ['set-recomm', 'id' => $data->id, 'from_id' => $fromId],
                                ['class' => 'btn btn-success col-xs-12']);
                        }
                    ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>

