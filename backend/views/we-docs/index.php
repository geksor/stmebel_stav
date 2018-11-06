<?php

use yii\helpers\Html;
use backend\widgets\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\WeDocsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Документы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="we-docs-index">

    <div class="box box-primary">
        <div class="box-body">
            <?php Pjax::begin(); ?>

            <p>
                <?= Html::a('Создать документ', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    [
                        'attribute' => 'docNameReal',
                        'format' => 'raw',
                        'filter' => false,
                        'value' => function ($data){
                            /* @var $data \common\models\WeDocs*/
                            if ($data->docNameReal){
                                return Html::a('Открыть документ', $data->documentLink, ['target' => '_blank', 'data-pjax' => 0]);
                            }
                            return 'Не загружен';
                        },
                    ],
                    'docNameView',
                    [
                        'attribute' => 'itemImage',
                        'format' => 'raw',
                        'filter' => false,
                        'value' => function ($data){
                            /* @var $data \common\models\WeDocs */
                            return Html::img($data->getImages('we-docs')['thumb_image'], ['style' => 'max-width: 100px;']);
                        }
                    ],
                    'itemDescription:ntext',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
