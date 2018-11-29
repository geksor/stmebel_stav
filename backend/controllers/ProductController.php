<?php

namespace backend\controllers;

use common\models\Attr;
use common\models\AttrValue;
use common\models\ProductAttr;
use common\models\ProductAttrSearch;
use common\models\ProductSearchRecomm;
use common\models\RecommendedProduct;
use common\models\RecommendedProductSearch;
use Yii;
use common\models\Product;
use common\models\ProductSearch;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAddRecomm($par_id)
    {
        $searchModel = new ProductSearchRecomm();
        $searchModel->fromId = $par_id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('add-recomm', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'fromId' => $searchModel->fromId,
        ]);
    }

    /**
     * @param $id
     * @param $from_id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionSetRecomm($id, $from_id)
    {
        if (Yii::$app->request->isAjax){

            $model = $this->findModel($from_id);

            $model->saveRecomm($id);
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchModel = new RecommendedProductSearch();
        $searchModel->product_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionRecommView($id)
    {
        $searchModel = new RecommendedProductSearch();
        $searchModel->product_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('recomm-view', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Product model.
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
     * @param null $id
     * @param null $product_id
     * @param null $recommProduct_id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id = null, $product_id = null, $recommProduct_id = null)
    {
        if ($id){
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }
        if ($product_id && $recommProduct_id){
            $dellLink = RecommendedProduct::findOne(['product_id' => $product_id, 'recommProduct_id' => $recommProduct_id]);
            if ($dellLink){
                $dellLink->delete();
            }
            return $this->redirect(['view', 'id' => $product_id]);
        }
        Yii::$app->session->setFlash('error', 'Ошибка. Обратитель к администратору');
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @param $id
     * @param $publish
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionPublish($id, $publish)
    {
        if (Yii::$app->request->isAjax){

            $model = $this->findModel($id);

            $model->publish = (integer) $publish;

            if ($model->save()){
                return $this->redirect(Yii::$app->request->referrer);
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
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionCategories($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->saveCategories($model->selectCat);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('categories', [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionCopyProduct($id)
    {
        $copyModel = $this->findModel($id);

        $options = $copyModel->productOptions;
        $attrs = $copyModel->productAttrs;

        $model = new Product();

        $model->attributes = $copyModel->attributes;

        if ($model->copySave($copyModel, $options, $attrs)){
            return $this->redirect(['view', 'id' => $model->id]);
        }
        Yii::$app->session->setFlash('error', 'Ошибка. Обратитесь к системному администратору');
        return $this->redirect(['view', 'id' => $id]);
    }

}
