<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\OrderOptRbSec */

$this->title = 'Редактирование: '.$model->title;
$this->params['breadcrumbs'][] = ['label' => 'Выбор из нескольких', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="order-opt-rb-sec-update">

    <div class="box box-primary">
        <div class="box-body">

            <P>
                <?= Html::a('<i class="fa fa-reply" aria-hidden="true"></i>', ['view', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
            </P>

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
