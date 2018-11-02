<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\HowWeWorkStep */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Как мы работаем шаги', 'url' => ['index', 'par_id' => $model->houWeWork_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="how-we-work-step-view">

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
                <?= Html::a('Создать шаг', ['create', 'par_id' => $model->houWeWork_id], ['class' => 'btn btn-default']) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    [
                        'attribute' => 'houWeWork_id',
                        'value' => function ($data) {
                            /* @var $data \common\models\HowWeWorkStep*/
                            return $data->houWeWork->title;
                        }
                    ],
                    'rank',
                    'title',
                    'description:ntext',
                    [
                        'attribute' => 'publish',
                        'label' => 'Состояние',
                        'value' => function ($data){
                            /* @var $data \common\models\Comment */
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
