<?php
namespace frontend\controllers;

use backend\models\Contact;
use common\models\Certificate;
use common\models\Comment;
use common\models\WeDocs;
use common\models\WePartner;
use Yii;
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
        return $this->render('index');
    }

    /**
     * Displays reviews
     *
     * @return string
     */
    public function actionReviews()
    {
        $model = Comment::find()->where(['publish' => 1])->orderBy(['created_at' => SORT_ASC])->all();

        return $this->render('reviews', [
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
        return $this->render('about');
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

    public function actionPartner()
    {
        $model = WePartner::findOne(['id' => 1]);

        return $this->render('partner', [
            'model' => $model,
        ]);
    }

    public function actionDocuments()
    {
        $modelDoc = WeDocs::find()->all();
        $modelCert = Certificate::findOne(['id' => 1]);

        return $this->render('documents', [
            'modelDoc' => $modelDoc,
            'modelCert' => $modelCert,
        ]);
    }
}
