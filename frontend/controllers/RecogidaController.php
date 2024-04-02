<?php

namespace frontend\controllers;

use frontend\models\Recogida;
use frontend\models\RecogidaSearch;
use frontend\models\Solicitud;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * RecogidaController implements the CRUD actions for Recogida model.
 */
class RecogidaController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
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
     * Lists all Recogida models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new RecogidaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Recogida model.
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('kv-detail-success', 'La información ha sido guardada correctamente');
            // Multiple alerts can be set like below
           // Yii::$app->session->setFlash('kv-detail-warning', 'A last warning for completing all data.');
           // Yii::$app->session->setFlash('kv-detail-info', '<b>Note:</b> You can proceed by clicking <a href="#">this link</a>.');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('view', [ 'model' => $model]);
        }
    }

    /**
     * Creates a new Recogida model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($idsolicitud)
    {
        
        $model = new Recogida();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                $solicitud=Solicitud::find()->andWhere(['status'=>1,'id'=>$idsolicitud])->one();
                if($solicitud)
                {
                    $solicitud->updateAttributes(['tipo_estado_solicitudid'=>3,'fecha_rec'=>date('Y-m-d')]);
                    SolicitudController::Notificarestado($solicitud,2);
                    return $this->redirect(['solicitud/detalles','id'=>$solicitud->id]);
     
                }
                // $solicitud->updateAttributes(['tipo_estado_solicitudid'=>3,'fecha_rec'=>date('Y-m-d')]);
                // $this->Notificarestado($solicitud);
                // return $this->redirect(['detalles','id'=>$solicitud->id]);

                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'idsolicitud'=>$idsolicitud,
        ]);
    }

    /**
     * Updates an existing Recogida model.
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
     * Deletes an existing Recogida model.
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
     * Finds the Recogida model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Recogida the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Recogida::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
