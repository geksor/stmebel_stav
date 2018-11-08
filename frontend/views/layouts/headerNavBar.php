
<nav class="navbar navbar-dark navbar-expand-lg pr-lg-0 col-12 col-lg-10">

    <a class="navbar-brand" href="<?= Yii::$app->homeUrl?>">
        <img src="/public/images/logo.png" alt="<?= Yii::$app->name ?>">
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarText">

        <?= \yii\widgets\Menu::widget([
            'items' => [
                ['label' => 'Строительство домов', 'url' => ['catalog/index', 'alias' => 'proizvodstvo-mebeli', 'child' => 'divani']],
                ['label' => 'Строительство заборов', 'url' => ['catalog/index', 'alias' => 'proizvodstvo-mebeli', 'child' => 'kategoria-6']],
                ['label' => 'Производство мебели', 'url' => ['catalog/index', 'alias' => 'proizvodstvo-mebeli', 'child' => 'kategoria-6']],
            ],
            'options' => [
                'class' => 'navbar-nav mr-auto mt-4 mt-lg-0',
            ],
            'labelTemplate' =>'{label} Label',
            'linkTemplate' => '<a class="nav-link text-center" href="{url}">{label}</a>',
            'itemOptions'=>['class'=>'nav-item mx-2 pt-3 pt-lg-2'],
        ]) ?>

    </div>

</nav>
