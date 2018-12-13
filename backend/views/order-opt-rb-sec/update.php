<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\OrderOptRbSec */

$this->title = 'Update Order Opt Rb Sec: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Order Opt Rb Secs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
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
