<?php
namespace frontend\controllers;

use common\models\AboutPage;
use common\models\AgreePage;
use common\models\AllReviews;
use common\models\CallBack;
use common\models\Contact;
use common\models\DeliveryPage;
use common\models\SiteSettings;
use common\models\ThreeBlock;
use frontend\widgets\ModalsWidget;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $siteSettings = new SiteSettings();
        $threeBlock = new ThreeBlock();

        return $this->render('index', [
            'siteSettings' => $siteSettings,
            'threeBlock' => $threeBlock,
        ]);
    }

    public function actionAgree()
    {
        $siteSettings = new SiteSettings();
        $model = new AgreePage();

        return $this->render('agree', [
            'siteSettings' => $siteSettings,
            'model' => $model,
        ]);
    }


    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        $model = new AboutPage();
        $model->load(Yii::$app->params);

        return $this->render('about', [
            'model' => $model,
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new Contact();
        $model->load(Yii::$app->params);

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionDelivery()
    {
        $siteSettings = new SiteSettings();
        $model = new DeliveryPage();

        return $this->render('delivery', [
            'siteSettings' => $siteSettings,
            'model' => $model,
        ]);
    }

    public function actionCallBack()
    {
        $model = new CallBack();

        if ($model->load(Yii::$app->request->post())){
            if ($model->lastName){
                return $this->redirect(Yii::$app->request->referrer);
            }
            if ($model->save()){
                \Yii::$app->session->setFlash('popUp', 'Ваша заявка принята');
                if (ArrayHelper::keyExists('chatId', Yii::$app->params['Contact'])){
                    $message = "Запрос обратного звонка\n Имя: $model->name \n Телефон: $model->phone";
                    \Yii::$app->bot->sendMessage((integer)Yii::$app->params['Contact']['chatId'], $message);
                }
                $model->sendEmail();
            }else{
                \Yii::$app->session->setFlash('popUp', 'Ошибка. Попробуйте еще раз');
            }
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionAlertWidget()
    {
        if (Yii::$app->request->isPjax){
            return $this->renderAjax(ModalsWidget::widget());
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

}
