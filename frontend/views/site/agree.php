<?php

/* @var $this \frontend\components\View */
/* @var $siteSettings \common\models\SiteSettings */

$this->registerMetaTag([
    'name' => 'title',
    'content' => $siteSettings->meta_title,
]);
$this->registerMetaTag([
    'name' => 'description',
    'content' => $siteSettings->meta_description,
]);

$this->title = 'Соглашение';
$this->params['breadcrumbs'][] = $this->title;
?>
