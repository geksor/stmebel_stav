<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\WeDocs */

$this->title = 'Создание документа';
$this->params['breadcrumbs'][] = ['label' => 'Документы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="we-docs-create">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
