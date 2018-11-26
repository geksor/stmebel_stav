<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\AttrValue */

$this->title = $model->value;
$this->params['breadcrumbs'][] = ['label' => 'Значения атрибута', 'url' => ['index', 'par_id' => $model->attr_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attr-list-view">

    <div class="box box-primary">
        <div class="box-body">

            <p>
                <?= Html::a('<i class="fa fa-reply" aria-hidden="true"></i>', ['index', 'par_id' => $model->attr_id], ['class' => 'btn btn-default']) ?>
                <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Продолжить удаление?',
                        'method' => 'post',
                    ],
                ]) ?>
                <?= Html::a('Создать', ['create', 'par_id' => $model->attr_id], ['class' => 'btn btn-success']) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'value',
                    [
                        'attribute' => 'attr_id',
                        'value' => function ($data){
                            /* @var $data \common\models\AttrValue */
                            return $data->attr->title;
                        }
                    ],
                ],
            ]) ?>

        </div>
    </div>

</div>
