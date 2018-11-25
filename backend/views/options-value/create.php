<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\OptionsValue */

$this->title = 'Create Options Value';
$this->params['breadcrumbs'][] = ['label' => 'Options Values', 'url' => ['index']];
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
