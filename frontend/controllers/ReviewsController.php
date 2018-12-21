<?php
namespace frontend\controllers;

use common\models\AllReviews;
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

}
