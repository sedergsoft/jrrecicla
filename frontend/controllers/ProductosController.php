<?php

namespace frontend\controllers;

use Exception;
use frontend\models\Model;
use frontend\models\Productos;
use frontend\models\ProductosSearch;
use frontend\models\TipoProducto;
use frontend\models\TipoProductoProductos;
use frontend\models\TipoProductoProductosSearch;
use kartik\widgets\ActiveForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Response;

/**
 * ProductosController implements the CRUD actions for Productos model.
 */
class ProductosController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
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
            ]
        );
    }

    /**
     * Lists all Productos models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProductosSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Productos model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
      if(Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);   
        }
        $model=$this->findModel($id);
        $searchModel = new TipoProductoProductosSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->andWhere(['status'=>1,'productosid'=>$model->id])->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('kv-detail-success', 'La información ha sido guardada correctamente');
            // Multiple alerts can be set like below
           // Yii::$app->session->setFlash('kv-detail-warning', 'A last warning for completing all data.');
           // Yii::$app->session->setFlash('kv-detail-info', '<b>Note:</b> You can proceed by clicking <a href="#">this link</a>.');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('view', [ 'model' => $model, 
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,]);
        }
    }

    /**
     * Creates a new Productos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Productos();
        $TipoProd = [new TipoProductoProductos()];

        if ($this->request->isPost) {
            
                if ($model->load($this->request->post()) && $model->load(Yii::$app->request->post())) {

                    $TipoProd = Model::createMultiple(TipoProductoProductos::classname());
                    Model::loadMultiple($TipoProd, Yii::$app->request->post());
        
                    // ajax validation
                    if (Yii::$app->request->isAjax) {
                        Yii::$app->response->format = Response::FORMAT_JSON;
                        return ArrayHelper::merge(
                            ActiveForm::validateMultiple($TipoProd),
                            ActiveForm::validate($model)
                        );
                    }
        
                    // validate all models
                    $valid = $model->validate();
                    $valid = Model::validateMultiple($TipoProd) && $valid;
                    
                    if ($valid) {
                        $transaction = \Yii::$app->db->beginTransaction();
                        try {
                            if ($flag = $model->save(false)) {
                                foreach ($TipoProd as $modelProducto) {
                                    $modelProducto->productosid = $model->id;
                                    if (! ($flag = $modelProducto->save(false))) {
                                        $transaction->rollBack();
                                        break;
                                    }
                                }
                            }
                            if ($flag) {
                                $transaction->commit();
                                return $this->redirect(['view', 'id' => $model->id]);
                            }
                        } catch (Exception $e) {
                            $transaction->rollBack();
                        }
                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'TipoProd'=>$TipoProd,
        ]);
    }

    /**
     * Updates an existing Productos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Productos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Productos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Productos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Productos::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
