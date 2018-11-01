<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\Comment */

$this->title = "Отзыв от $model->user_name";
$this->params['breadcrumbs'][] = ['label' => 'Отзывы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-view">

    <div class="box box-primary">
        <div class="box-body">
            <?php Pjax::begin(); ?>
            <p>
                <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

                <? if ($model->publish) {?>
                    <?= Html::a('Снять с публикации', ['publish', 'id' => $model->id, 'publish' => false], ['class' => 'btn btn-danger']) ?>
                <?}else{?>
                    <?= Html::a('Опубликовать', ['publish', 'id' => $model->id, 'publish' => true], ['class' => 'btn btn-primary']) ?>
                <?}?>

                <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Вы уверены что хотите удалить данный отзыв?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    [
                        'attribute' => 'created_at',
                        'headerOptions' => ['width' => '150'],
                        'format' => ['date', 'php:d.m.Y - H:i:s'],
                    ],
                    [
                        'attribute' => 'done_at',
                        'headerOptions' => ['width' => '150'],
                        'format' => ['date', 'php:d.m.Y - H:i:s'],
                    ],
//                    'viewed',
                    'user_name',
                    'text:ntext',
                    'email:email',
                    [
                        'attribute' => 'publish',
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
            <?php Pjax::end(); ?>
        </div>
    </div>

</div>
