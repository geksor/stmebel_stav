<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\CallBack */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Обратная связь', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="call-back-view">

    <div class="box box-primary">
        <div class="box-body">
            <?php Pjax::begin(); ?>
            <? if ($model->viewed !== 2) {?>
                <p>
                    <?= Html::a('Обработать', ['success', 'id' => $model->id, 'success' => 2], ['class' => 'btn btn-success'])?>
                </p>
            <?}?>

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
                    'name',
                    'phone',
                ],
            ]) ?>
            <?php Pjax::end(); ?>
        </div>
    </div>

</div>
