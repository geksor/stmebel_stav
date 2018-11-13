
<nav class="navbar navbar-dark navbar-expand-lg pr-lg-0 col-12 col-lg-10">

    <a class="navbar-brand" href="<?= Yii::$app->homeUrl?>">
        <img src="/public/images/logo.png" alt="<?= Yii::$app->name ?>">
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <?= \frontend\widgets\HeaderMenuWidget::widget() ?>

</nav>
