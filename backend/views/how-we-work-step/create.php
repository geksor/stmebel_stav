<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\HowWeWorkStep */

$this->title = 'Создание шага';
$this->params['breadcrumbs'][] = ['label' => 'Как мы работаем шаги', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="how-we-work-step-create">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
