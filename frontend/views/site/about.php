<?php

/* @var $this \frontend\components\View */
/* @var $model \common\models\AboutPage */

if ($model->title){
    $this->title = $model->title;
}else{
    $this->title = 'О нас';
}

$this->registerMetaTag([
    'name' => 'title',
    'content' => $model->meta_title,
]);
$this->registerMetaTag([
    'name' => 'description',
    'content' => $model->meta_description,
]);
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="content flex_1">
    <div class="onas flex">
        <div class="onas_left">
            <h1><?= $this->title ?></h1>
            <?= $model->description ?>
        </div>
    </div>
</div>

