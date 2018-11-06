<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\WeDocs */

$this->title = $model->docNameView;
$this->params['breadcrumbs'][] = ['label' => 'Документы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="we-docs-view">

    <div class="box box-primary">
        <div class="box-body">

            <p>
                <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Удалить запись?',
                        'method' => 'post',
                    ],
                ]) ?>
                <?= Html::a('Загрузить документ', ['upload-document', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
                <?= Html::a('Загрузить изображение', ['set-image', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    [
                        'attribute' => 'docNameReal',
                        'format' => 'raw',
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
                        'value' => function ($data){
                            /* @var $data \common\models\WeDocs */
                            return Html::img($data->getImages('we-docs')['thumb_image'], ['style' => 'max-width: 100px;']);
                        }
                    ],
                    'itemDescription:ntext',
                ],
            ]) ?>

        </div>
    </div>

</div>
