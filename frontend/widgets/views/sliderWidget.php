<?

/* @var $model \common\models\Slider */


?>

<div class="head_4 flex">
<? if ($model) {?>
    <div class="slider2 owl-carousel owl-theme flex">
        <? foreach ($model->getBehavior('galleryBehavior')->getImages() as $image) {
        /* @var $image \zxbodya\yii2\galleryManager\GalleryImage */ ?>
                <div class="head_slide item">
                    <a href="<?= $image->description ?>">
                        <?= \yii\helpers\Html::img(
                            $image->getUrl('medium'),
                            [
                                'class' => 'img-fluid',
                                'alt' => $image->name,
                            ]) ?>
                    </a>
                </div>
        <?}?>
    </div>
<?}?>
</div>

