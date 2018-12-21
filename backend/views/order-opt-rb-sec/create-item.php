<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\OrderOptRbItem */
/* @var $parentTitle */

$this->title = 'Создание варианта';
$this->params['breadcrumbs'][] = ['label' => $parentTitle, 'url' => ['view', 'id' => $model->section_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-opt-rb-sec-create">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form-item', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
