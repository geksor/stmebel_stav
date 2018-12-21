<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\OrderOptCheckbox */

$this->title = 'Создание опции';
$this->params['breadcrumbs'][] = ['label' => 'Одиночные опции', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-opt-checkbox-create">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
