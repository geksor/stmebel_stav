<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\OrderOptRbItem */
/* @var $parentTitle */

$this->title = 'Update Order Opt Rb Sec: '.$model->title;
$this->params['breadcrumbs'][] = ['label' => $parentTitle, 'url' => ['view', 'id' => $model->section_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="order-opt-rb-sec-update">

    <div class="box box-primary">
        <div class="box-body">

            <P>
                <?= Html::a('<i class="fa fa-reply" aria-hidden="true"></i>', ['view', 'id' => $model->section_id], ['class' => 'btn btn-default']) ?>
            </P>

            <?= $this->render('_form-item', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
