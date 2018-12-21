<?php
namespace frontend\controllers;

use common\models\AllReviews;
use common\models\Contact;
use common\models\SiteSettings;
use frontend\models\SiteSearch;
use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class ReviewsController extends Controller
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

        $models = AllReviews::find()->where(['publish' => 1])->orderBy(['created_at' => SORT_ASC])->all();

        $formModel = new AllReviews();

        return $this->render('index', [
            'siteSettings' => $siteSettings,
            'models' => $models,
            'formModel' => $formModel,
        ]);
    }


    public function actionSendReviews()
    {
        $reviewsModel = new AllReviews();
        $contactModel = new Contact();

        if ( $reviewsModel->load( Yii::$app->request->post() ) && !$reviewsModel->lastName ) {
            if ($reviewsModel->save()){
                Yii::$app->session->setFlash('success', 'Спасибо за ваш отзыв.');
                $message = "Новый отзыв\n Имя: $reviewsModel->user_name \n Текст отзыва: $reviewsModel->text";
                if ($contactModel->chatId){
                    \Yii::$app->bot->sendMessage((integer)$contactModel->chatId, $message);
                }
                if ($contactModel->email){
                    $reviewsModel->sendEmail();
                }
                return $this->redirect(Yii::$app->request->referrer);
            }
        }
        Yii::$app->session->setFlash('error', 'Что то пошло не так.');
        return $this->redirect(Yii::$app->request->referrer);
    }
}
