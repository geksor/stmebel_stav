<?php
namespace backend\controllers;

use backend\models\WebVisitor;
use common\models\AboutPage;
use common\models\AgreePage;
use common\models\Contact;
use common\models\DeliveryPage;
use common\models\SiteSettings;
use common\models\ThreeBlock;
use nox\components\http\userAgent\UserAgentParser;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'login',
                            'error',
                        ],
                        'allow' => true,
                    ],
                    [
                        'actions' => [
                            'logout',
                            'error',
                            'index',
                            'contact',
                            'about-page',
                            'site-settings',
                            'delivery-page',
                            'agree-page',
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $counter_direct = WebVisitor::getStat(WebVisitor::TYPE_DIRECT);
        $counter_inner = WebVisitor::getStat(WebVisitor::TYPE_INNER);
        $counter_ads = WebVisitor::getStat(WebVisitor::TYPE_ADS);
        $counter_search = WebVisitor::getStat(WebVisitor::TYPE_SEARCH);

        $browserStat = WebVisitor::getBrowserStat();
        $labelsChart = [];
        $dataChart = [];
        $tempArr = [];
        if ($browserStat){
            foreach ($browserStat as $item){
                /* @var $item WebVisitor */
                $browser = UserAgentParser::parse($item->user_agent)['browser'];
                if (array_key_exists($browser, $tempArr)){
                    $tempArr[$browser][0] = $tempArr[$browser][0]+$item->visits;
                }else{
                    $tempArr[$browser][0] = $item->visits;
                }
            }
            foreach ($tempArr as $key => $item){
                $labelsChart[] = $key;
                $dataChart[] = $item[0];
            }
        }

        return $this->render('index', [
            'counter_direct' => $counter_direct,
            'counter_inner' => $counter_inner,
            'counter_ads' => $counter_ads,
            'counter_search' => $counter_search,
            'labelsChart' => json_encode($labelsChart),
            'dataChart' => json_encode($dataChart),
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionContact()
    {
        $model = new Contact();

        if ($model->load(Yii::$app->params)) {
            if (Yii::$app->request->post()) {
                $model->save(Yii::$app->request->post('Contact'));
                return $this->redirect(['contact']);
            }
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }
    /**
     * @return string|\yii\web\Response
     */
    public function actionSiteSettings()
    {
        $model = new SiteSettings();

        if (Yii::$app->request->post()) {
            $model->save(Yii::$app->request->post('SiteSettings'));
            return $this->redirect(['site-settings']);
        }

        return $this->render('site-settings', [
            'model' => $model,
        ]);
    }
    /**
     * @return string|\yii\web\Response
     */
    public function actionThreeBlock()
    {
        $model = new ThreeBlock();

        if (Yii::$app->request->post()) {
            $model->save(Yii::$app->request->post('ThreeBlock'));
            return $this->redirect(['three-block']);
        }

        return $this->render('three-block', [
            'model' => $model,
        ]);
    }
    /**
     * @return string|\yii\web\Response
     */
    public function actionDeliveryPage()
    {
        $model = new DeliveryPage();

        if (Yii::$app->request->post()) {
            $model->save(Yii::$app->request->post('DeliveryPage'));
            return $this->redirect(['delivery-page']);
        }

        return $this->render('delivery-page', [
            'model' => $model,
        ]);
    }
    /**
     * @return string|\yii\web\Response
     */
    public function actionAgreePage()
    {
        $model = new AgreePage();

        if (Yii::$app->request->post()) {
            $model->save(Yii::$app->request->post('AgreePage'));
            return $this->redirect(['agree-page']);
        }

        return $this->render('agree-page', [
            'model' => $model,
        ]);
    }

    /**
     * @param null $image
     * @return string|\yii\web\Response
     */
    public function actionAboutPage()
    {
        $model = new AboutPage();

        if ($model->load(Yii::$app->params)) {
            if (Yii::$app->request->post()) {
                $model->save(Yii::$app->request->post('AboutPage'));
                return $this->redirect(['about-page']);
            }
        }

        return $this->render('about-page', [
            'model' => $model,
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
