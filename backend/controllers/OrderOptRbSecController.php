<?php

namespace backend\controllers;

use common\models\OrderOptRbItem;
use common\models\OrderOptRbItemSearch;
use Yii;
use common\models\OrderOptRbSec;
use common\models\OrderOptRbSecSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderOptRbSecController implements the CRUD actions for OrderOptRbSec model.
 */
class OrderOptRbSecController extends Controller
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
                            'view',
                            'create',
                            'update',
                            'delete',
                            'rank',
                            'create-item',
                            'update-item',
                            'delete-item',
                            'rank-item',
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all OrderOptRbSec models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderOptRbSecSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OrderOptRbSec model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchModel = new OrderOptRbItemSearch();
        $searchModel->section_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new OrderOptRbItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateItem($id)
    {
        $model = new OrderOptRbItem();
        $model->section_id = $id;

        $parentTitle = OrderOptRbSec::findOne($id)->title;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->section_id]);
        }

        return $this->render('create-item', [
            'model' => $model,
            'parentTitle' => $parentTitle,
        ]);
    }

    /**
     * Creates a new OrderOptRbSec model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new OrderOptRbSec();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing OrderOptRbItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdateItem($id)
    {
        $model = $this->findModelItem($id);

        $parentTitle = $this->findModel($id)->title;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->section_id]);
        }

        return $this->render('update-item', [
            'model' => $model,
            'parentTitle' => $parentTitle,
        ]);
    }

    /**
     * Updates an existing OrderOptRbSec model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing OrderOptRbSec model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing OrderOptRbItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDeleteItem($id)
    {
        $this->findModelItem($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the OrderOptRbSec model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OrderOptRbSec the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OrderOptRbSec::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Finds the OrderOptRbItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OrderOptRbItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelItem($id)
    {
        if (($model = OrderOptRbItem::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @param $id
     * @param $rank
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionRank($id, $rank)
    {
        if (Yii::$app->request->isAjax){

            $model = $this->findModel($id);

            if ($model){
                $model->rank = (integer) $rank;

                if ($model->save()){
                    return $this->redirect(Yii::$app->request->referrer);
                }
            }
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * @param $id
     * @param $rank
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionRankItem($id, $rank)
    {
        if (Yii::$app->request->isAjax){

            $model = $this->findModelItem($id);

            if ($model){
                $model->rank = (integer) $rank;

                if ($model->save()){
                    return $this->redirect(Yii::$app->request->referrer);
                }
            }
        }
        return $this->redirect(Yii::$app->request->referrer);
    }
}
