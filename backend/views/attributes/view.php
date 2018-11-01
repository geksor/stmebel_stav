<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Attributes */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Атрибуты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attributes-view">

    <div class="box box-primary">
        <div class="box-body">

            <p>
                <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Удалить атрибут?',
                        'method' => 'post',
                    ],
                ]) ?>
                <? if ($model->type > 1 && $model->type < 4) {?>
                    <?= Html::a('Значения атрибута', [$model->type === 2?'attr-list/index':'attr-color/index', 'par_id' => $model->id], ['class' => 'btn btn-default']) ?>
                <?}?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'title',
                    'viewName',
                    [
                        'attribute' => 'type',
                        'value' => function ($data) {
                            /* @var $data \common\models\Attributes */
                            switch ($data->type){
                                case 1:
                                    return 'Строка';
                                case 2:
                                    return 'Список';
                                case 3:
                                    return 'Цвет';
                            }
                            return 'Не задан';
                        }
                    ],
                ],
            ]) ?>
        </div>
    </div>

</div>
