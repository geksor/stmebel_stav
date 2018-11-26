<?php

use yii\helpers\Html;
use backend\widgets\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\RecommendedProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $fromId */

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <?= \common\widgets\Alert::widget() ?>

    <div class="box box-primary">
        <div class="box-body">

            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <p>
                <?= Html::a('<i class="fa fa-reply" aria-hidden="true"></i>', ['view', 'id' => $searchModel->product_id], ['class' => 'btn btn-default']) ?>
                <?= Html::a('Выбрать', ['add-recomm', 'par_id' => $searchModel->product_id], ['class' => 'btn btn-success']) ?>
            </p>
            <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'label' => 'Изображение',
                        'format' => 'raw',
                        'headerOptions' => ['width' => 50],
                        'value' => function ($data){
                            /* @var $data \common\models\RecommendedProduct */
                            return Html::img($data->recommProduct->getThumbMainImage(), ['width' => 60]);
                        }
                    ],
                    [
                        'attribute' => 'recommProduct_id',
                        'value' => function ($data){
                            /* @var $data \common\models\RecommendedProduct */
                            return $data->recommProduct->title;
                        }
                    ],

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{delete}'
                    ],
                ],
            ]); ?>

            <?php Pjax::end(); ?>
        </div>
    </div>

</div>

