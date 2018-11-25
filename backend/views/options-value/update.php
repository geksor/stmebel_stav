<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\OptionsValue */

$this->title = 'Update Options Value: '.$model->value;
$this->params['breadcrumbs'][] = ['label' => 'Options Values', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->value, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="options-value-update">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
