<?php

namespace backend\controllers;

use Yii;
use common\models\RecommendedProduct;
use common\models\RecommendedProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RecommendedProductController implements the CRUD actions for RecommendedProduct model.
 */
class RecommendedProductController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all RecommendedProduct models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RecommendedProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RecommendedProduct model.
     * @param integer $product_id
     * @param integer $recommProduct_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($product_id, $recommProduct_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($product_id, $recommProduct_id),
        ]);
    }

    /**
     * Creates a new RecommendedProduct model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RecommendedProduct();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'product_id' => $model->product_id, 'recommProduct_id' => $model->recommProduct_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing RecommendedProduct model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $product_id
     * @param integer $recommProduct_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($product_id, $recommProduct_id)
    {
        $model = $this->findModel($product_id, $recommProduct_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'product_id' => $model->product_id, 'recommProduct_id' => $model->recommProduct_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing RecommendedProduct model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $product_id
     * @param integer $recommProduct_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($product_id, $recommProduct_id)
    {
        $this->findModel($product_id, $recommProduct_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RecommendedProduct model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $product_id
     * @param integer $recommProduct_id
     * @return RecommendedProduct the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($product_id, $recommProduct_id)
    {
        if (($model = RecommendedProduct::findOne(['product_id' => $product_id, 'recommProduct_id' => $recommProduct_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
