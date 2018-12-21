<?php

namespace backend\controllers;

use common\models\Product;
use Yii;
use common\models\ProductImages;
use common\models\ProductImagesSearch;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductImagesController implements the CRUD actions for ProductImages model.
 */
class ProductImagesController extends Controller
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
                            'title',
                            'set-main-image',
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
     * Lists all ProductImages models.
     * @return mixed
     */
    public function actionIndex($par_id)
    {
        $searchModel = new ProductImagesSearch();
        $searchModel->product_id = $par_id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductImages model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * @param $par_id
     * @return string|\yii\web\Response
     * @throws \yii\base\ErrorException
     * @throws \yii\base\Exception
     */
    public function actionCreate($par_id)
    {
        if ((int)ProductImages::find()->where(['product_id' => $par_id])->count() === 4){
            Yii::$app->session->setFlash('warning', 'Достигнуто максимальное количество изображений');
            return $this->redirect(['index', 'par_id' => $par_id]);
        }
        $model = new ProductImages();
        $model->product_id = $par_id;

        if ($model->load(Yii::$app->request->post())) {

            $file = UploadedFile::getInstance($model, 'uploadImage');

            if ($file){
                if ($model->save() && $model->saveProductImage($file,$model->image,$model->crop_info,$model->product_id)){
                    return $this->redirect(['index', 'par_id' => $model->product_id]);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ProductImages model.
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
     * Deletes an existing ProductImages model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();

        return $this->redirect(['index', 'par_id' => $model->product_id]);
    }

    /**
     * Finds the ProductImages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductImages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductImages::findOne($id)) !== null) {
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
     * @param $title
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionTitle($id, $title)
    {
        if (Yii::$app->request->isAjax){

            $model = $this->findModel($id);

            if ($model){
                $model->title = (string) $title;

                if ($model->save()){
                    return $this->redirect(Yii::$app->request->referrer);
                }
            }
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionSetMainImage($id, $image)
    {
        if (Yii::$app->request->isAjax){

            $model = Product::findOne($id);

            if ($model){
                $model->main_image = (string) $image;

                if ($model->save()){
                    return $this->redirect(Yii::$app->request->referrer);
                }
            }
        }
        return $this->redirect(Yii::$app->request->referrer);
    }
}
