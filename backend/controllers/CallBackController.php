<?php

namespace backend\controllers;

use Yii;
use common\models\CallBack;
use common\models\CallBackSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CallBackController implements the CRUD actions for CallBack model.
 */
class CallBackController extends Controller
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
     * Lists all CallBack models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CallBackSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CallBack model.
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
     * Deletes an existing CallBack model.
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
     * Finds the CallBack model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CallBack the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CallBack::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @param $id
     * @param $success
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionSuccess($id, $success)
    {
        if (Yii::$app->request->isAjax){

            $model = $this->findModel($id);

            $model->viewed = (integer) $success;
            $model->done_at = time();

            if ($model->save(false)){
                return $this->redirect(['index']);
            }
        }
        return $this->redirect(['index']);
    }


    /**
     * @param \yii\base\Action $action
     * @param mixed $result
     * @return mixed
     */
    public function afterAction($action, $result)
    {
        if ($action->id === 'index'){
            CallBack::updateAll(['viewed' => 2], 'viewed = 0');
        }
        return parent::afterAction($action, $result); // TODO: Change the autogenerated stub
    }

}
