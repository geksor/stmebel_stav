<?php

/* @var $this \frontend\components\View */
/* @var $model \common\models\WePartner */


$this->headerClass = 'documents';
$this->title = 'Партнеры';
$this->params['breadcrumbs'][] = $this->title;
?>

<? if ($model) {?>
<div id="partners" class="container mw-1200 mt-5 pt-5">
    <div class="row justify-content-between">
        <? foreach ($model->getBehavior('galleryBehavior')->getImages() as $image) {/* @var $image \zxbodya\yii2\galleryManager\GalleryImage */?>

            <div class="item col-lg-3 col-sm-6 col-12 mt-5 align-self-center text-center">
                <img src="<?= $image->getUrl('medium') ?>" alt="<?= $image->name ?>">
            </div>

        <?}?>
    </div>
</div>
<?}?>