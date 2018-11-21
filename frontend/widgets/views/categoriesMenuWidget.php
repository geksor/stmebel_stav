<?

/* @var $items \frontend\widgets\HeaderMenuWidget */


?>

<div class="catalogMenu noneClose position-absolute w-100 container-fluid pb-5" id="catalogMenu">

    <div class="container mw-1200">
        <div class="catalogMenu__headLine d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Каталог товаров и услуг</h2>
            <div class="catalogMenu__close"><svg
                        xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink"
                        width="33px" height="33px" viewBox="0 0 33 33">
                    <path fill-rule="evenodd"  fill="rgb(59, 57, 65)"
                          d="M18.621,16.500 L32.410,30.289 C32.996,30.874 32.996,31.824 32.410,32.410 C31.824,32.996 30.874,32.996 30.289,32.410 L16.500,18.621 L2.711,32.410 C2.126,32.996 1.176,32.996 0.590,32.410 C0.004,31.824 0.004,30.874 0.590,30.289 L14.379,16.500 L0.590,2.711 C0.004,2.126 0.004,1.176 0.590,0.590 C1.176,0.004 2.126,0.004 2.711,0.590 L16.500,14.379 L30.289,0.590 C30.874,0.004 31.824,0.004 32.410,0.590 C32.996,1.176 32.996,2.126 32.410,2.711 L18.621,16.500 Z"/>
                </svg></div>
        </div>
        <div class="navbar-collapse navbar-dark" style="overflow: hidden">
            <?= \yii\widgets\Menu::widget([
                'items' => $items,
                'options' => [
                    'class' => 'navbar-nav navbar-expand-sm d-flex flex-wrap',
                    'style' => 'margin-right:-3rem;'
                ],
                'labelTemplate' =>'{label} Label',
                'linkTemplate' => '<a class="nav-link px-1 py-1" methods="POST" href="{url}">{label}</a>',
                'itemOptions'=>['class'=>'nav-item mr-5 mb-5'],
                'submenuTemplate' => "\n<ul class='navbar-nav flex-column' role='menu'>\n{items}\n</ul>\n",
            ]) ?>
        </div>
    </div>
</div>

<script>
    window.onload = function () {
        $('.weService').on('click', function (event) {
            event.preventDefault();
            $('#catalogMenu').show('blind', 400);
        });
        $('.catalogMenu__close').on('click', function () {
            $('#catalogMenu').hide('blind', 400);
        });
        $(document).on('click', function (event) {
            if ($(event.target).closest(".noneClose").length) {
                return;
            }
            $('#catalogMenu').hide('blind', 400);
            event.stopPropagation();
        });
    }
</script>

