<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\AttrValue */

$this->title = $model->value;
$this->params['breadcrumbs'][] = ['label' => 'Заполнение списка', 'url' => ['index', 'par_id' => $model->attr_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attr-list-view">

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
                        'attribute' => 'attr_id',
                        'value' => function ($data){
                            /* @var $data \common\models\AttrList */
                            return $data->attr->title;
                        }
                    ],
                ],
            ]) ?>

        </div>
    </div>

</div>
