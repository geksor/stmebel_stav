<?

/* @var $model \common\models\Slider */


?>

<div class="mainSlider">

    <? foreach ($model->getBehavior('galleryBehavior')->getImages() as $image) {
    /* @var $image \zxbodya\yii2\galleryManager\GalleryImage */ ?>

        <div>
            <div class="row">
                <div class="col-12 col-lg-7 text-center text-lg-left align-self-center pr-lg-0">
                    <h1>
                        <?= $image->name ?>
                    </h1>
                    <p><?= $image->description ?></p>
                </div>
                <div class="col-12 col-lg-5 text-center">
                    <?= \yii\helpers\Html::img(
                        $image->getUrl('medium'),
                        [
                            'class' => 'img-fluid',
                            'alt' => $image->name,
                        ]) ?>
                </div>
            </div>
        </div>

    <?}?>

</div>
