<?php

/* @var $this \frontend\components\View */
/* @var $siteSettings \common\models\SiteSettings */
/* @var $threeBlock \common\models\ThreeBlock */

$this->registerMetaTag([
    'name' => 'title',
    'content' => $siteSettings->meta_title,
]);
$this->registerMetaTag([
    'name' => 'description',
    'content' => $siteSettings->meta_description,
]);

$this->title = 'Мебель в Ставрополе';
?>

<?= \frontend\widgets\CategoryForMainWidget::widget() ?>
<?= \frontend\widgets\ProductsForMainWidget::widget() ?>
<div class="uslugi cont flex_2">
    <div class="usluga">
        <img src="<?= $threeBlock->one_image?$threeBlock->one_image:'public/img/usluga_1.svg'?>" alt="<?= $threeBlock->one_title ?>">
        <h4><?= $threeBlock->one_title ?></h4>
        <p><?= $threeBlock->one_text ?></p>
    </div>
    <div class="usluga">
        <img src="<?= $threeBlock->two_image?$threeBlock->two_image:'public/img/usluga_2.svg'?>" alt="<?= $threeBlock->two_title ?>">
        <h4><?= $threeBlock->two_title ?></h4>
        <p><?= $threeBlock->two_text ?></p>
    </div>
    <div class="usluga">
        <img src="<?= $threeBlock->three_image?$threeBlock->three_image:'public/img/usluga_3.svg'?>" alt="<?= $threeBlock->three_title ?>">
        <h4><?= $threeBlock->three_title ?></h4>
        <p><?= $threeBlock->three_text ?></p>
    </div>
</div>