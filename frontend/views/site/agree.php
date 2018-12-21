<?php

/* @var $this \frontend\components\View */
/* @var $siteSettings \common\models\SiteSettings */
/* @var $model \common\models\AgreePage */

$this->registerMetaTag([
    'name' => 'title',
    'content' => $model->meta_title?$model->meta_title:$siteSettings->meta_title,
]);
$this->registerMetaTag([
    'name' => 'description',
    'content' => $model->meta_description?$model->meta_description:$siteSettings->meta_description,
]);

$this->title = $model->title?$model->title:'Соглашение';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $model->pageCode ?>
