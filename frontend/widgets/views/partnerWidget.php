<?

/* @var $model \common\models\WePartner */
/* @var $imageCount \frontend\widgets\PartnerWidget */

?>

<div id="partners" class="container mw-1200 mt-5 pt-5">
    <div class="row justify-content-center">
        <div class="col-12 mb-5 text-center text-md-left">
            <h2 class="text-center text-lg-left">Наши партнеры</h2>
        </div>
        <? if ($model) {?>
            <? foreach ($model->getBehavior('galleryBehavior')->getImages() as $key => $image) {/* @var $image \zxbodya\yii2\galleryManager\GalleryImage */?>
                <? if ($key < $imageCount) {?>
                    <div class="item col-lg-3 col-sm-6 col-12 mt-2 mt-lg-0 align-self-center text-center">
                        <img src="<?= $image->getUrl('medium') ?>" alt="<?= $image->name ?>">
                    </div>
                <?}else{
                    break;
                }?>
            <?}?>
        <?}?>
    </div>
</div>
