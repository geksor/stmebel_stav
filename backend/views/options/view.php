<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Options */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Характеристики', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="options-view">

    <div class="box box-primary">
        <div class="box-body">

            <p>
                <?= Html::a('<i class="fa fa-reply" aria-hidden="true"></i>', ['index'], ['class' => 'btn btn-default']) ?>
                <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Продолжить удаление?',
                        'method' => 'post',
                    ],
                ]) ?>
                <?= Html::a('Создать характеристику', ['create'], ['class' => 'btn btn-success']) ?>
                <? if (!$model->allCats) {?>
                    <?= Html::a('Для категорий', ['categories', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
                <?}?>
                <? if ($model->type) {?>
                    <?= Html::a('Значения характеристики', ['/options-value', 'par_id' => $model->id], ['class' => 'btn btn-default']) ?>
                <?}?>

            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'title',
                    [
                        'attribute' => 'type',
                        'value' => function ($data){
                            /* @var $data \common\models\Options */
                            return $data->type?'Список':'Строка';
                        }
                    ],
                    'allCats:boolean',
                    'rank',
                ],
            ]) ?>

        </div>
    </div>

</div>
