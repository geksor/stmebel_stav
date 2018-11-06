<?php

namespace backend\controllers;

use common\models\DocumentUpload;
use common\models\ImageUpload;
use Yii;
use common\models\WeDocs;
use common\models\WeDocsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * WeDocsController implements the CRUD actions for WeDocs model.
 */
class WeDocsController extends Controller
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
     * Lists all WeDocs models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WeDocsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single WeDocs model.
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
     * Creates a new WeDocs model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new WeDocs();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing WeDocs model.
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
     * Deletes an existing WeDocs model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the WeDocs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return WeDocs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WeDocs::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUploadDocument($id)
    {
        $model = new DocumentUpload();
        $link = $this->findModel($id);

        if (Yii::$app->request->isPost)
        {
            $file = UploadedFile::getInstance($model, 'document');

            if ($link->saveDocument($model->uploadFile($file, $link->docNameReal)))
            {
                return $this->redirect(['view', 'id' => $link->id]);
            }
        }

        return $this->render('upload-document', [
            'model' => $model,
            'link' => $link,
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     * @throws \yii\base\Exception
     */
    public function actionSetImage($id)
    {
        $model = new ImageUpload();
        $imageFrom = $this->findModel($id);

        if (Yii::$app->request->isPost && Yii::$app->request->post('ImageUpload')['crop_info'])
        {
            $file = UploadedFile::getInstance($model, 'image');
            $cropInfo = Yii::$app->request->post('ImageUpload')['crop_info'];
            $dir = 'we-docs';

            if ($imageFrom->saveImage($model->uploadFile($file, $imageFrom->itemImage, $cropInfo, $dir)))
            {
                return $this->redirect(['view', 'id' => $imageFrom->id]);
            }
        }

        return $this->render('set-image', [
            'model' => $model,
            'imageFrom' => $imageFrom,
        ]);
    }

}
