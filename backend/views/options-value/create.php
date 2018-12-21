<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\OptionsValue */

$this->title = 'Создание значения';
$this->params['breadcrumbs'][] = ['label' => 'Значения характеристики', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="options-value-create">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
