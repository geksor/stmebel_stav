<?php

/* @var $this \frontend\components\View */
/* @var $modelDoc \common\models\WeDocs */
/* @var $modelCert \common\models\Certificate */


$this->headerClass = 'documents';
$this->title = 'Документы';
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="docs" class="container mw-1200 mt-5 pt-5">
    <div class="row justify-content-center justify-content-lg-between">
        <div class="col-11 col-lg-12 text-justify text-lg-left">
            <? foreach ($modelDoc as $key => $item) { /* @var $item \common\models\WeDocs */?>
                <div class="row <?= $key === 0? '':'mt-3'?>">
                    <div class="col-12 col-md-2 text-center align-self-center">
                        <img src="<?= $item->getImages('we-docs')['thumb_image'] ?>">
                    </div>
                    <div class="col">
                        <a class="d-block text-center d-md-inline" target="_blank" href="<?= $item->getDocumentLink() ?>">
                            <?= $item->docNameView ?>.pdf
                        </a>
                        <p class="mt-2 mt-md-0">
                            <?= $item->itemDescription ?>
                        </p>
                    </div>
                </div>
            <?}?>
        </div>
    </div>
</div>

<? if ($modelCert) {?>
<div id="houses" class="container mw-1200 mt-5 pt-5">
    <div class="row justify-content-center">
        <div class="col-12 mb-5 text-center text-md-left">
            <h2 class="text-center text-lg-left">Сертификаты</h2>
        </div>
        <? foreach ($modelCert->getBehavior('galleryBehavior')->getImages() as $image) {/* @var $image \zxbodya\yii2\galleryManager\GalleryImage */?>
            <div class="col-12 col-md-6 col-lg-3 mt-4 text-center">
                <a href="<?=$image->getUrl('original')?>" data-fancybox="certificate" data-caption="<?=$image->name?>">
                    <img src="<?= $image->getUrl('medium') ?>" class="img-fluid" alt="<?= $image->name ?>">
                </a>
            </div>
        <?}?>
    </div>
</div>
<?}?>