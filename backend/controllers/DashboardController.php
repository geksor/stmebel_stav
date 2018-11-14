<?php
/**
 * @project: yii2-stat
 * @description Multi web stat and analytics module
 * @author: akiraz2
 * @license: MIT
 * @copyright (c) 2018.
 */

namespace backend\controllers;

use akiraz2\stat\models\WebVisitor;
use akiraz2\stat\models\WebVisitorSearch;
use backend\models\WebVisitorViewSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class DashboardController extends Controller
{

    public function actionIndex()
    {
        $searchModel = new WebVisitorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $counter_direct = WebVisitor::getStat(WebVisitor::TYPE_DIRECT);
        $counter_ads = WebVisitor::getStat(WebVisitor::TYPE_ADS);
        $counter_search = WebVisitor::getStat(WebVisitor::TYPE_SEARCH);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'counter_direct' => $counter_direct,
            'counter_ads' => $counter_ads,
            'counter_search' => $counter_search
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        $searchModel = new WebVisitorViewSearch();
        if ($model){
            $searchModel->cookie_id = $model->cookie_id;
            $searchModel->source = 1;
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('view', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return WebVisitor|null
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return WebVisitor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WebVisitor::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
