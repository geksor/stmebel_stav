<?php

namespace backend\controllers;

use Yii;
use common\models\ProductAttr;
use common\models\ProductAttrSearch;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductAttrController implements the CRUD actions for ProductAttr model.
 */
class ProductAttrController extends Controller
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
     * Lists all ProductAttr models.
     * @return mixed
     */
    public function actionIndex($par_id, $attr_id = null, $ajax = null)
    {
        $searchModel = new ProductAttrSearch();
        $searchModel->product_id = $par_id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $model = new ProductAttr();
        $model->product_id = $par_id;
        if ($attr_id){
            $model->attr_id = $attr_id;
        }
        $attrValue = $model::getAttrValueFromDropDown($attr_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model = new ProductAttr();
            $model->product_id = $par_id;

            return $this->redirect(['index', 'par_id' => $model->product_id,]);
        }

        if (Yii::$app->request->isAjax && $ajax){
            return $this->redirect(['index', 'par_id' => $par_id, 'attr_id' => $attr_id]);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            'attrValue' => $attrValue,
        ]);
    }

    /**
     * Creates a new ProductAttr model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($par_id, $attr_id = null)
    {
        $model = new ProductAttr();
        $model->product_id = $par_id;
        if ($attr_id){
            $model->attr_id = $attr_id;
        }
        $attrValue = $model::getAttrValueFromDropDown($attr_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'par_id' => $model->product_id,]);
        }

        if (Yii::$app->request->isAjax){
            return $this->redirect(['create', 'par_id' => $par_id, 'attr_id' => $attr_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'attrValue' => $attrValue,
        ]);
    }

    /**
     * Updates an existing ProductAttr model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $product_id
     * @param integer $attr_id
     * @param integer $attrValue_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($product_id, $attr_id, $attrValue_id)
    {
        $model = $this->findModel($product_id, $attr_id, $attrValue_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'product_id' => $model->product_id, 'attr_id' => $model->attr_id, 'attrValue_id' => $model->attrValue_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ProductAttr model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $product_id
     * @param integer $attr_id
     * @param integer $attrValue_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($product_id, $attr_id, $attrValue_id)
    {
        $this->findModel($product_id, $attr_id, $attrValue_id)->delete();

        return $this->redirect(['index', 'par_id' => $product_id]);
    }

    /**
     * Finds the ProductAttr model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $product_id
     * @param integer $attr_id
     * @param integer $attrValue_id
     * @return ProductAttr the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($product_id, $attr_id, $attrValue_id)
    {
        if (($model = ProductAttr::findOne(['product_id' => $product_id, 'attr_id' => $attr_id, 'attrValue_id' => $attrValue_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
