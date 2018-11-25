<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\OptionsValue */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Options Values', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="options-value-view">

    <div class="box box-primary">
        <div class="box-body">

            <p>
                <?= Html::a('<i class="fa fa-reply" aria-hidden="true"></i>', ['index', 'par_id' => $model->options_id], ['class' => 'btn btn-default']) ?>
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
                    'value',
                    [
                        'attribute' => 'options_id',
                        'value' => function ($data){
                            /* @var $data \common\models\OptionsValue */
                            return $data->options->title;
                        }
                    ],
                ],
            ]) ?>

        </div>
    </div>


</div>
