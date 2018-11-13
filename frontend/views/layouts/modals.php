<?= \frontend\widgets\CallBackWidget::widget() ?>

<div class="modal fade" tabindex="-1" role="dialog" id="popUp">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="text-center">
                    <?= Yii::$app->session->getFlash('popUp') ?>
                </h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
<? if (Yii::$app->session->hasFlash('popUp')) {
    $js = <<< JS
    $('#popUp').modal('show');
JS;

    $this->registerJs($js, $position = yii\web\View::POS_END, $key = null);
} ?>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="agree">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Согласие на обработку персональных данных</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Настоящим в соответствии с Федеральным законом № 152-ФЗ «О персональных данных» от 27.07.2006 года
                    свободно, своей волей и в своем интересе выражаю свое безусловное согласие на обработку моих
                    персональных данных ,
                    <?= Yii::$app->params['Contact']['companyType'] ?> <?= Yii::$app->params['Contact']['company_name'] ?>
                    (ИНН <?= Yii::$app->params['Contact']['inn'] ?>,
                    КПП <?= Yii::$app->params['Contact']['kpp'] ?>,
                    ОГРН <?= Yii::$app->params['Contact']['ogrn'] ?>)
                    зарегистрированным в соответствии с законодательством РФ по адресу: <br>
                    <?= Yii::$app->params['Contact']['corpAddress'] ?>(далее по тексту - Оператор).
                </p>
                <p>
                    Персональные данные - любая информация, относящаяся к определенному или определяемому на основании
                    такой информации физическому лицу. <br>
                    Настоящее Согласие выдано мною на обработку следующих персональных данных: <br>
                    - Имя; <br>
                    - Телефон; <br>
                    - Адрес электронной почты; <br>
                    - Сообщение. <br>
                </p>
                <p>
                    Согласие дано Оператору для совершения следующих действий с моими персональными данными с
                    использованием средств автоматизации и/или без использования таких средств: сбор, систематизация,
                    накопление, хранение, уточнение (обновление, изменение), использование, обезличивание, а также
                    осуществление любых иных действий, предусмотренных действующим законодательством РФ как
                    неавтоматизированными, так и автоматизированными способами. <br>
                    Данное согласие дается Операторудля обработки моих персональных данных в следующих целях: <br>
                    - предоставление мне услуг/работ; <br>
                    - направление в мой адрес уведомлений, касающихся предоставляемых услуг/работ; <br>
                    - подготовка и направление ответов на мои запросы; <br>
                    - направление в мой адрес информации, в том числе рекламной, о мероприятиях/товарах/услугах/работах
                    Оператора. <br>
                </p>
                <p>
                    Настоящее согласие действует до момента его отзыва путем направления соответствующего уведомления на
                    электронный адрес <?= Yii::$app->params['Contact']['email'] ?> В случае отзыва мною согласия на обработку персональных данных
                    Оператор вправе продолжить обработку персональных данных без моего согласия при наличии оснований,
                    указанных в пунктах 2 – 11 части 1 статьи 6, части 2 статьи 10 и части 2 статьи 11 Федерального
                    закона №152-ФЗ «О персональных данных» от 27.06.2006 г.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>