<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Attr */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Атрибуты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attributes-view">

    <div class="box box-primary">
        <div class="box-body">

            <p>
                <?= Html::a('<i class="fa fa-reply" aria-hidden="true"></i>', ['index'], ['class' => 'btn btn-default']) ?>
                <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Удалить атрибут?',
                        'method' => 'post',
                    ],
                ]) ?>
                <?= Html::a('Создать атрибут', ['create'], ['class' => 'btn btn-success']) ?>
                <? if (!$model->all_cats) {?>
                    <?= Html::a('Для категорий', ['categories', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
                <?}?>
                <?= Html::a('Значения атрибута', ['/attr-value', 'par_id' => $model->id], ['class' => 'btn btn-default']) ?>

            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'title',
                    'rank',
                    'all_cats:boolean'
                ],
            ]) ?>
        </div>
    </div>

</div>
