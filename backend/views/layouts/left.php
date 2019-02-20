<aside class="main-sidebar">

    <section class="sidebar">


        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Меню админпанели', 'options' => ['class' => 'header']],
                    [
                        'label' => 'Заказы',
                        'icon' => 'reply',
                        'url' => '#',
                        'items' => [
                            [
                                'label' => 'Опции заказа',
                                'icon' => 'phone-square',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Не одиночные', 'icon' => 'comments', 'url' => ['/order-opt-checkbox'], "active" => Yii::$app->controller->id === 'order-opt-checkbox',],
                                    [
                                        'label' => 'Одиночные',
                                        'icon' => 'comments',
                                        'url' => ['/order-opt-rb-sec'],
                                        "active" => Yii::$app->controller->id === 'order-opt-rb-sec',],
                                ]
                           ],
                            ['label' => 'Заказы', 'icon' => 'comments', 'url' => ['/order'], "active" => Yii::$app->controller->id === 'order',],
                        ],
                    ],
                    [
                        'label' => 'Обратная связь',
                        'icon' => 'reply',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Отзывы', 'icon' => 'comments', 'url' => ['/all-reviews'], "active" => Yii::$app->controller->id === 'all-reviews',],
                        ],
                    ],
                    [
                        'label' => 'Настройки сайта',
                        'icon' => 'cogs',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Общие настройки', 'icon' => 'thumbs-up', 'url' => ['/site/site-settings']],
                            ['label' => 'Слайдер', 'icon' => 'images', 'url' => ['/slider'], "active" => Yii::$app->controller->id === 'slider',],
                            ['label' => 'Контакты', 'icon' => 'address-card', 'url' => ['/site/contact']],
                            ['label' => 'О нас', 'icon' => 'info', 'url' => ['/site/about-page']],
                            ['label' => 'Доставка', 'icon' => 'truck', 'url' => ['/site/delivery-page']],
                            ['label' => 'Соглашение', 'icon' => 'check-square', 'url' => ['/site/agree-page']],
                            ['label' => 'Три блока', 'icon' => 'check-square', 'url' => ['/site/three-block']],
                        ],
                    ],
                    [
                        'label' => 'Каталог товаров',
                        'icon' => 'shopping-basket',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Категории', 'icon' => 'th', 'url' => ['/category'], "active" => Yii::$app->controller->id === 'category',],
                            [
                                'label' => 'Товары',
                                'icon' => 'archive',
                                'url' => ['/product'],
                                "active" => Yii::$app->controller->id === 'product'
                                    || Yii::$app->controller->id === 'product-attr'
                                    || Yii::$app->controller->id === 'product-options'
                                    || Yii::$app->controller->id === 'product-images',
                                ],
                            [
                                'label' => 'Атрибуты',
                                'icon' => 'tags',
                                'url' => ['/attr'],
                                "active" => Yii::$app->controller->id === 'attr'
                                    || Yii::$app->controller->id === 'attr-value',
                            ],
                            [
                                'label' => 'Характеристики',
                                'icon' => 'tags',
                                'url' => ['/options'],
                                "active" => Yii::$app->controller->id === 'options'
                                    || Yii::$app->controller->id === 'options-value',
                            ],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
