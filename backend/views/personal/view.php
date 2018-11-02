<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Personal */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Сотрудники', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personal-view">

    <div class="box box-primary">
        <div class="box-body">

            <p>
                <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Удалить сотрудника?',
                        'method' => 'post',
                    ],
                ]) ?>
                <?= Html::a('Выбрать фото', ['set-photo', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
                <?= Html::a('Создать', ['create'], ['class' => 'btn btn-default']) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'name',
                    'position',
                    [
                        'attribute' => 'image',
                        'format' => 'raw',
                        'value' => function ($data){
                            /* @var $data \common\models\Personal */
                            return Html::img($data->getPhotos('personal')['thumb_image'], ['style' => 'max-width: 200px;']);
                        }
                    ],
                    [
                        'attribute' => 'publish',
                        'label' => 'Состояние',
                        'value' => function ($data){
                            /* @var $data \common\models\Personal */
                            if ($data->publish){
                                return 'Опубликован';
                            }
                            return 'Не опубликован';
                        }
                    ],
                ],
            ]) ?>

        </div>
    </div>

</div>
