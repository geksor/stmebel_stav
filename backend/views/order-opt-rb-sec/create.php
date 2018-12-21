<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\OrderOptRbSec */

$this->title = 'Создание раздела выбор из нескольких';
$this->params['breadcrumbs'][] = ['label' => 'Выбор из нескольких', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-opt-rb-sec-create">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
