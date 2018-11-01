<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Certificate */

$this->title = 'Создание галереи сертификатов';
$this->params['breadcrumbs'][] = ['label' => 'Сертификаты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="certificate-create">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
