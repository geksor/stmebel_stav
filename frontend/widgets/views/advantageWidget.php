<?

/* @var $model \backend\models\Advantage */


?>

<div id="advantages" class="container mw-1200 mt-5 pt-5">
    <div class="row justify-content-center">
        <h2 class="col-11 text-center mb-5">Наши преимущества</h2>
        <div class="col-lg-3 col-sm-6 col-11 text-center">
            <img src="/uploads/images/params/thumb_<?= $model->image1 ?>" alt="advantageImage">
            <p class="mt-3">
                <?= $model->text1 ?>
            </p>
        </div>
        <div class="col-lg-3 col-sm-6 col-11 text-center">
            <img src="/uploads/images/params/thumb_<?= $model->image2 ?>" alt="advantageImage">
            <p class="mt-3">
                <?= $model->text2 ?>
            </p>
        </div>
        <div class="col-lg-3 col-sm-6 col-11 text-center">
            <img src="/uploads/images/params/thumb_<?= $model->image3 ?>" alt="advantageImage">
            <p class="mt-3">
                <?= $model->text3 ?>
            </p>
        </div>
        <div class="col-lg-3 col-sm-6 col-11 text-center">
            <img src="/uploads/images/params/thumb_<?= $model->image4 ?>" alt="advantageImage">
            <p class="mt-3">
                <?= $model->text4 ?>
            </p>
        </div>
    </div>
</div>
