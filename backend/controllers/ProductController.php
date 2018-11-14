<?php

namespace backend\controllers;

use backend\models\AttrProdSettings;
use common\models\Attributes;
use common\models\Category;
use common\models\CategoryProduct;
use Yii;
use common\models\Product;
use common\models\ProductSearch;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use zxbodya\yii2\galleryManager\GalleryManagerAction;

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
                            'attribute',
                            'order',
                            'publish',
                            'galleryApi',
                            'galleryApiAddBlock'
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public function actions()
    {
        return [
            'galleryApi' => [
                'class' => GalleryManagerAction::className(),
                // mappings between type names and model classes (should be the same as in behaviour)
                'types' => [
                    'product' => Product::className(),
                ]
            ],
            'galleryApiAddBlock' => [
                'class' => GalleryManagerAction::className(),
                // mappings between type names and model classes (should be the same as in behaviour)
                'types' => [
                    'productAddBlock' => Product::className(),
                ]
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
            'categories' => $this->getCategories(),
        ]);
    }

    /**
     * Displays a single Product model.
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
     * Attribute an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionAttribute($id)
    {
        $model = $this->findModel($id);

        $model->selectAttr = $model->selectedAttributes;

        $attributes = $model->catAttributes;

        $attrSet = new AttrProdSettings();
        $attrSet->viewAttr = $model->getViewAttr();
        $attrSet->viewOnWidget = $model->getViewOnWidget();

        if ($attrSet->load(Yii::$app->request->post())) {
            $model->saveAttr(
                Yii::$app->request->post('attrList'),
                Yii::$app->request->post('attrColor'),
                Yii::$app->request->post('attrString'),
                $attrSet->viewAttr,
                $attrSet->viewOnWidget
            );
            $model->saveAttrRank(Yii::$app->request->post('attrRank'));

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('attribute', [
            'model' => $model,
            'attrSet' => $attrSet,
            'attributes' => $attributes,
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
        $maxRank = $model->getMaxRank();
        $model->rank = $maxRank ? ++$maxRank : 1;


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'categories' => $this->getCategories(),
        ]);
    }

    /**
     * @return array
     */
    public function getCategories()
    {
        $categoryIdArr = ArrayHelper::getColumn(
            CategoryProduct::find()->groupBy('category_id')->select('category_id')->asArray()->all(),
            'category_id'
        );
        return ArrayHelper::map(Category::find()->where(['id' => $categoryIdArr])->all(), 'id', 'title');
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
        $model->selectCategory = $model->selectedCategories;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'categories' => $this->getCategories(),
        ]);
    }

    /**
     * Deletes an existing Product model.
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
     * @param $order
     * @param $up
     * @return bool|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionOrder($id, $order, $up)
    {
        if (Yii::$app->request->isAjax){
            $maxOrder = Product::find()->max('rank');

            if ($order <= $maxOrder){

                $model = $this->findModel($id);

                $model->rank = (integer) $order;
                $model->selectCategory = $model->selectedCategories;

                while (!$modelReplace = Product::find()->where(['rank' => $order])->one()){
                    $up ? $order-- : $order++;
                }
                $modelReplace->selectCategory = $modelReplace->selectedCategories;

                $modelReplace->rank = $up ? ++$modelReplace->rank : --$modelReplace->rank;
                if ($modelReplace->rank === $model->rank){
                    $modelReplace->rank = $up ? ++$modelReplace->rank : --$modelReplace->rank;
                }

                if ($model->save() && $modelReplace->save()){
                    return $this->redirect(Yii::$app->request->referrer);
                }
            }
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->redirect(Yii::$app->request->referrer);
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
            $model->selectCategory = $model->selectedCategories;

            if ($model->save()){
                return $this->redirect(Yii::$app->request->referrer);
            }
        }
        return $this->redirect(Yii::$app->request->referrer);
    }
}
