<?

/* @var $model \common\models\Comment */

?>

<div id="reviews" class="container mw-1200 mt-5">
    <div class="row justify-content-center py-5 mx-0 review">
        <h2 class="col-11 text-center mb-5">Отзывы наших клиентов</h2>
        <div class="col-11 mb-2 text-center">
            <span class="name">
                <?= $model->user_name ?>,&nbsp;
            </span>
            <span class="date">
                <?= Yii::$app->formatter->asDate($model->created_at, 'long') ?>
            </span>
        </div>
        <p class="mb-5 col-11 col-lg-10 fs-13 text-center">
            <?= $model->text ?>
        </p>
        <div class="col-6 text-right">
            <a class="btn btn-outline-light my-2 my-sm-0 rounded-0" href="/reviews#reviews-form">Написать отзыв</a>
        </div>
        <div class="col-6 text-left">
            <a class="btn btn-outline-light my-2 my-sm-0 rounded-0" href="reviews">Посмотреть все</a>
        </div>
    </div>
</div>
