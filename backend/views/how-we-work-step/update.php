<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\HowWeWorkStep */

$this->title = 'Редактирование шага: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Как мы работаем шаги', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="how-we-work-step-update">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
