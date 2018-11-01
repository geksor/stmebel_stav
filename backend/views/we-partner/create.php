<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\WePartner */

$this->title = 'Создание записи';
$this->params['breadcrumbs'][] = ['label' => 'Партнеры', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="we-partner-create">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
