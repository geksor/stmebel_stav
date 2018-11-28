<?

/* @var $items \frontend\widgets\HeaderMenuWidget */
/* @var $models \common\models\Category */

?>

<div class="content_catalog cont flex">
    <? foreach ($models as $model) {/* @var $model \common\models\Category */?>

        <a class="category" href = "/catalog/<?= $model->alias ?>">
            <?= $model->image ?>
            <h2><?= $model->title ?></h2>
        </a>
    <?}?>
    <a class="category category_all" href = "/catalog">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 63 63">
            <path class="fill_category" fill-rule="evenodd" d="M31.499 63C14.13 63 0 48.869 0 31.5S14.13 0 31.499 0s31.5 14.131 31.5 31.5S48.868 63 31.499 63zm0-58.688C16.507 4.312 4.312 16.508 4.312 31.5c0 14.991 12.195 27.187 27.187 27.188 14.992-.001 27.187-12.197 27.187-27.189 0-14.99-12.195-27.187-27.187-27.187zm4.23 40.679a2.156 2.156 0 1 1-3.049-3.049l8.285-8.285-23.991-.002a2.156 2.156 0 1 1 0-4.312l23.992.002-8.286-8.286a2.157 2.157 0 0 1 3.049-3.05l11.967 11.967a2.154 2.154 0 0 1 0 3.05L35.729 44.991z"></path>
        </svg>
        <h2>ПЕРЕЙТИ В КАТАЛОГ</h2>
    </a>
</div>
