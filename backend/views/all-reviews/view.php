<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\AllReviews */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'All Reviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="all-reviews-view">

    <div class="box box-primary">
        <div class="box-body">
            <?php Pjax::begin(); ?>
            <p>
                <?= Html::a('<i class="fa fa-reply" aria-hidden="true"></i>', ['index'], ['class' => 'btn btn-default']) ?>
                <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Вы уверены что хотите удалить запись?',
                        'method' => 'post',
                    ],
                ]) ?>
                <? if ($model->publish) {?>
                    <?= Html::a('Снять с публикации', ['publish', 'id' => $model->id, 'publish' => false], ['class' => 'btn btn-default']) ?>
                <?}else{?>
                    <?= Html::a('Опубликовать', ['publish', 'id' => $model->id, 'publish' => true], ['class' => 'btn btn-default']) ?>
                <?}?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'user_name',
                    'email:email',
                    'text:ntext',
                    'created_at:datetime',
                    'done_at:datetime',
                    'publish:boolean',
                ],
            ]) ?>
            <?php Pjax::end(); ?>
        </div>
    </div>

</div>
