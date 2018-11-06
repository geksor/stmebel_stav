<?php
namespace backend\controllers;

use backend\models\AboutHome;
use backend\models\AboutPage;
use backend\models\Advantage;
use backend\models\Contact;
use common\models\ImageUpload;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use yii\web\UploadedFile;

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
                            'ya-map',
                            'contact',
                            'about-home',
                            'about-page',
                            'advantage',
                            'set-image',
                            ],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', ],
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
        return $this->render('index');
    }

    /**
     * @return string
     */
    public function actionYaMap()
    {
        return $this->render('ya-map');
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
     * @param null $image
     * @return string|\yii\web\Response
     */
    public function actionAboutHome($image = null)
    {
        $model = new AboutHome();

        if ($model->load(Yii::$app->params)) {
            if ($image){
                $model->image = $image;
                $model->save($model);
            }
            if (Yii::$app->request->post()) {
                $model->save(Yii::$app->request->post('AboutHome'));
                return $this->redirect(['about-home']);
            }
        }

        return $this->render('about-home', [
            'model' => $model,
        ]);
    }

    /**
     * @param null $image
     * @return string|\yii\web\Response
     */
    public function actionAboutPage($image = null)
    {
        $model = new AboutPage();

        if ($model->load(Yii::$app->params)) {
            if ($image){
                $model->image = $image;
                $model->save($model);
            }
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
     * @param null $image
     * @param null $blockNum
     * @return string|\yii\web\Response
     */
    public function actionAdvantage($image = null, $blockNum = null)
    {
        $model = new Advantage();

        if ($model->load(Yii::$app->params)) {
            if ($image && $blockNum){
                switch ($blockNum){
                    case 1:
                        $model->image1 = $image;
                        break;
                    case 2:
                        $model->image2 = $image;
                        break;
                    case 3:
                        $model->image3 = $image;
                        break;
                    case 4:
                        $model->image4 = $image;
                        break;
                }
                $model->save($model);
            }
            if (Yii::$app->request->post()) {
                $model->save(Yii::$app->request->post('Advantage'));
                return $this->redirect(['advantage']);
            }
        }

        return $this->render('advantage', [
            'model' => $model,
        ]);
    }

    /**
     * @param $actionName
     * @param $width
     * @param $height
     * @param null $oldImage
     * @return string|\yii\web\Response
     * @throws \yii\base\Exception
     */
    public function actionSetImage($actionName, $width, $height, $oldImage = null, $blockNum = null)
    {
        $model = new ImageUpload();

        if (Yii::$app->request->isPost)
        {
            $file = UploadedFile::getInstance($model, 'image');
            $cropInfo = Yii::$app->request->post('ImageUpload')['crop_info'];

            return $this->redirect(['/site/'. $actionName, 'image' => $model->uploadFile($file, $oldImage, $cropInfo, 'params'), 'blockNum' => $blockNum]);
        }

        return $this->render('set-image', [
            'model' => $model,
            'width' => $width,
            'height' => $height,
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
