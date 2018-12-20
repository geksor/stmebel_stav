<?php

/* @var $this \frontend\components\View */
/* @var $model \common\models\Contact */


if ($model->title){
    $this->title = $model->title;
}else{
    $this->title = 'Контакты';
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
    <div class="kont flex">
        <h1><?= $this->title ?></h1>
        <div class="kont_left">
            <h2><?= $model->company_name ?></h2>
            <p class="kont_flex"><img src="/public/img/map.svg" alt=""><?= $model->address ?></p>
            <p class="kont_flex"><img src="/public/img/phone.svg" alt=""><?= $model->phone_1 ?><? if ($model->phone_1 && $model->phone_2) {?>,<?}?> <?= $model->phone_2 ?></p>
            <p class="kont_flex"><img src="/public/img/mail.svg" alt=""><?= $model->email ?></p>
            <h2>График работы:</h2>
            <p>Пн-Сб: <?= $model->mo_sa ?></p>
            <p>Вс: <?= $model->su ?></p>
            <p>Перерыв: <?= $model->break ?></p>
        </div>
        <div class="kont_right">
            <?= $model->mapScript ?>
        </div>
    </div>
</div>
