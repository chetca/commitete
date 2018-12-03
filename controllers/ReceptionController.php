<?php

namespace app\controllers;

use Yii;
use app\models\Reception;
use app\models\ReceptionSearch;
use app\models\Time;
use app\controllers\UsersController;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Request;

/**
 * ReceptionController implements the CRUD actions for Reception model.
 */
class ReceptionController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all Reception models.
     * @return mixed
     */    
    public function actionIndex()
    {
        $currentDate = date('Y-m-d');
        $queryParams = Yii::$app->request->queryParams;
        /*
        if (!$queryParams) {
            $queryParams['ReceptionSearch']['date'] = $currentDate;
        }
        */
        if (!Yii::$app->request->get()) {
            return $this->redirect(['index', 'ReceptionSearch[date]' => $currentDate]);
        }
        $searchModel = new ReceptionSearch();
        $dataProvider = $searchModel->search($queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    

    /**
     * Displays a single Reception model.
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
     * Creates a new Reception model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Reception();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Reception model.
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
     * Deletes an existing Reception model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = new Reception();
        $model->deleteUser($id);
        return $this->redirect(['index', 'ReceptionSearch[date]' => Yii::$app->request->get('ReceptionSearch')['date']]);
    }

    /**
     * Select all time.
     * @return mixed
     */
    public function actionTime()
    {
        $model = new Reception();
        $countTime = Time::find()->count();
        if ($model->load(Yii::$app->request->post())) {
            $operatorPlan = Yii::$app->request->post('Reception')['operatorPlan'];
            $datePlan = Yii::$app->request->post('Reception')['datePlan'];
            if($model->saveTime($operatorPlan, $datePlan, $countTime)) {
                return $this->redirect(['index', 'ReceptionSearch[date]' => $datePlan]);
            } else {
                \Yii::$app->session->addFlash('danger', 'Ошибка! Данный день уже запланирован');
                return $this->render('time', ['model' => $model]);
            }
        } else {
            return $this->render('time', ['model' => $model]);
        }
    }

    /**
     * Remove all time.
     * @return mixed
     */
    public function actionRemove()
    {
        $model = new Reception();
        $countTime = Time::find()->count();
        if ($model->load(Yii::$app->request->post())) {
            $operatorPlan = Yii::$app->request->post('Reception')['operatorPlan'];
            $datePlan = Yii::$app->request->post('Reception')['datePlan'];
            $model->removeTime($operatorPlan, $datePlan);
            return $this->redirect(['index']);
        }     
        return $this->render('remove', ['model' => $model]);
    }

    /**
     * Finds the Reception model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Reception the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Reception::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
