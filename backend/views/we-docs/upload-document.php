<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $link common\models\WeDocs */
/* @var $model common\models\DocumentUpload */

$this->title = 'Загрузка документа: ' . $link->docNameView;
$this->params['breadcrumbs'][] = ['label' => 'Документы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $link->docNameView, 'url' => ['view', 'id' => $link->id]];
$this->params['breadcrumbs'][] = 'Загрузка документа';
?>
<div class="we-docs-upload">

    <div class="box box-primary">
        <div class="box-body">

            <?= $this->render('_form-doc', [
                'model' => $model,
            ]) ?>

        </div>
    </div>

</div>
