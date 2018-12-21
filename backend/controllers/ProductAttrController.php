<?php

namespace backend\controllers;

use common\models\Product;
use Yii;
use common\models\ProductAttr;
use common\models\ProductAttrSearch;
use yii\filters\AccessControl;
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
                            'delete',
                            'rank',
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

        if ($model->load(Yii::$app->request->post())) {
            $model->rank = $model->attrValue->rank;
            if ($model->save()) {
                $model = new ProductAttr();
                $model->product_id = $par_id;

                return $this->redirect(['index', 'par_id' => $model->product_id,]);
            }
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
     * @param $id
     * @param $rank
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionRank($product_id, $attr_id, $attrValue_id, $rank)
    {
        if (Yii::$app->request->isAjax){

            $model = $this->findModel($product_id, $attr_id, $attrValue_id);

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
