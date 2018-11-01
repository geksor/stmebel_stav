<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\AttrColor */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Заполнение цвета', 'url' => ['index', 'par_id' => $model->attr_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attr-color-view">
    <style>
        .attrColor{
            width: 50px;
            height: 50px;
        }
    </style>

    <div class="box box-primary">
        <div class="box-body">

            <p>
                <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Продолжить удаление?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'title',
                    [
                        'attribute' => 'color',
                        'format' => 'raw',
                        'value' => function ($data){
                            /* @var $data \common\models\AttrColor */
                            return Html::tag('div', null, ['class' => 'attrColor', 'style' => "background-color: $data->color;"]);
                        }
                    ],
                    [
                        'attribute' => 'attr_id',
                        'value' => function ($data){
                            /* @var $data \common\models\AttrColor */
                            return $data->attr->title;
                        }
                    ],
                ],
            ]) ?>

        </div>
    </div>

</div>
