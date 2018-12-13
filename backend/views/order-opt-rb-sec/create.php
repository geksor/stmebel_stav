<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\OrderOptRbSec */

$this->title = 'Create Order Opt Rb Sec';
$this->params['breadcrumbs'][] = ['label' => 'Order Opt Rb Secs', 'url' => ['index']];
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
