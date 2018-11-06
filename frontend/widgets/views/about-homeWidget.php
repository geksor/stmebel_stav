<?

/* @var $model \backend\models\AboutHome */


?>

<div id="professionals" class="container mw-1200 mt-5 pt-5">
    <div class="row justify-content-lg-between justify-content-center">
        <div class="col-11 col-lg-7">
            <h2 class="text-center text-lg-left"><?= $model->title ?></h2>
            <div class="mt-5 mb-0 text-justify text-lg-left">
                <?= $model->description ?>
            </div>
            <div class="row mt-3 justify-content-center">
                <div class="col-12 col-sm-3 col-lg-4 text-center text-sm-left">
                    <p class="big-blue"><?= $model->blockTitle_1 ?></p>
                    <p class="mb-0">
                        <?= $model->blockDesc_1 ?>
                    </p>
                </div>
                <div class="col-12 col-sm-3 col-lg-4 text-center text-sm-left">
                    <p class="big-blue"><?= $model->blockTitle_2 ?></p>
                    <p class="mb-0">
                        <?= $model->blockDesc_2 ?>
                    </p>
                </div>
                <div class="col-12 col-sm-3 col-lg-4 text-center text-sm-left">
                    <p class="big-blue"><?= $model->blockTitle_3 ?></p>
                    <p class="mb-0">
                        <?= $model->blockDesc_3 ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-11 col-lg-5 align-self-end text-center mt-4 mt-lg-0">
            <img src="/uploads/images/params/thumb_<?= $model->image ?>" class="img-fluid" alt="<?= $model->title ?>">
        </div>
    </div>
</div>
