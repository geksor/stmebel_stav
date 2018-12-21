<?php

use yii\helpers\Html;
use backend\widgets\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ProductImagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Изображения товара';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-images-index">
    <?= \common\widgets\Alert::widget() ?>

    <div class="box box-primary">
        <div class="box-body">
            <?php Pjax::begin(); ?>

            <p>
                <?= Html::a('<i class="fa fa-reply" aria-hidden="true"></i>', ['product/view', 'id' => $searchModel->product_id], ['class' => 'btn btn-default']) ?>
                <?= Html::a('Загрузить', ['create', 'par_id' => $searchModel->product_id], ['class' => 'btn btn-success']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'format' => 'raw',
                        'value' => function ($data){
                            /* @var $data \common\models\ProductImages */
                            $checked = \common\models\Product::findOne($data->product_id)->main_image === $data->image;
                            $label = $checked?'Основное':'Выбрать основным';
                            return Html::radio('mainImage' ,$checked, ['id' => $data->product_id, 'value' => $data->image, 'label' => $label]);
                        }
                    ],
                    [
                        'attribute' => 'image',
                        'filter' => false,
                        'format' => 'raw',
                        'value' => function ($data){
                            /* @var $data \common\models\ProductImages */
                            return Html::img($data->getThumbImage(),['width' => 150]);
                        }
                    ],
                    [
                        'attribute' => 'title',
                        'format' => 'raw',
                        'value' => function ($data){
                            /* @var $data \common\models\ProductImages */
                            return Html::input('text', 'title' ,$data->title, ['class' => 'form-control', 'id' => $data->id]);
                        }

                    ],
                    [
                        'attribute' => 'rank',
                        'format' => 'raw',
                        'value' => function ($data){
                            /* @var $data \common\models\ProductImages */
                            return Html::input('number', 'rank' ,$data->rank, ['class' => 'form-control', 'id' => $data->id]);
                        }

                    ],

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{delete}'
                    ],
                ],
            ]); ?>
            <?
            $js = <<< JS
    $('[name = rank]').keypress(function(e){
        if(e.keyCode==13){
            $.ajax({
                type: "GET",
                url: "/admin/product-images/rank",
                data: 'id='+ $(this).attr('id') +'&rank='+ $(this).val(),
            })
        }
    });
    $('[name = title]').keypress(function(e){
        if(e.keyCode==13){
            $.ajax({
                type: "GET",
                url: "/admin/product-images/title",
                data: 'id='+ $(this).attr('id') +'&title='+ $(this).val(),
            })
        }
    });
    $('[name = mainImage]').change(function(e){
            $.ajax({
                type: "GET",
                url: "/admin/product-images/set-main-image",
                data: 'id='+ $(this).attr('id') +'&image='+ $(this).val(),
            })
    });
JS;

            $this->registerJs($js, $position = yii\web\View::POS_END, $key = null);
            ?>
            <?php Pjax::end(); ?>
        </div>
    </div>

</div>
