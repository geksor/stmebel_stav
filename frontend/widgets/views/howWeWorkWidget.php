<?

/* @var $model \common\models\HowWeWork */

?>

<div id="how-we-work" class="container mw-1200 mt-5 pt-5">
    <div class="row justify-content-center justify-content-lg-between">
        <div class="col-12 mb-5 text-center text-md-left">
            <h2 class="text-center text-lg-left">Как мы работаем</h2>
        </div>
        <div class="col-11 col-lg-6 text-justify text-lg-left">
            <? foreach ($model->howWeWorkSteps as $step) {/* @var $step \common\models\HowWeWorkStep */?>
                <p class="font-weight-bold black">
                    <span class="rounded-circle blue-span first mr-2"><?= $step->rank ?></span>
                    <?= $step->title ?>
                </p>
                <p>
                    <?= $step->description ?>
                </p>
            <?}?>
        </div>
        <div class="col-11 col-lg-5 text-center mt-3 mt-lg-0">
            <? foreach ($model->getBehavior('galleryBehavior')->getImages() as $key => $image) {/* @var $image \zxbodya\yii2\galleryManager\GalleryImage */?>

                <?= \yii\helpers\Html::img($image->getUrl('medium'), ['alt' => $image->name, 'class' => $key === 0?'img-fluid':'img-fluid mt-5']) ?>

            <?}?>
        </div>
    </div>
</div>
