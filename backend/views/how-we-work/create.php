<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\HowWeWork */

$this->title = 'Создание записи';
$this->params['breadcrumbs'][] = ['label' => 'Как мы работаем', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="how-we-work-create">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
