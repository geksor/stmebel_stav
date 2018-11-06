<?

/* @var $model \backend\models\AboutPage */


?>

<div id="about-text" class="container mw-1200 mt-5 pt-5">
    <div class="row justify-content-center justify-content-lg-between">
        <div class="col-11 col-lg-6 text-justify text-lg-left">
            <?= $model->description ?>
        </div>
        <div class="col-11 col-lg-5 mt-3 mt-lg-0 text-center">
            <img src="/uploads/images/params/thumb_<?= $model->image ?>" class="img-fluid" alt="Изображение">
        </div>
    </div>
</div>
