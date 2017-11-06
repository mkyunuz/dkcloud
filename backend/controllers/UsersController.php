<?php

namespace backend\controllers;

use Yii;
use backend\models\Users;
use backend\models\UsersSearch;
use backend\models\TitikAssignment;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller
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
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Users model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
     public function actionPointAssignment($id)
    {
        $model = new TitikAssignment;
        $userModel = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            // $assigment = $_POST['TitikAssignment']['titik_id'];
            // echo $userModel->nik; die();
            if(isset($_POST['TitikAssignment']['titik_id'])){
                $assigment = $_POST['TitikAssignment']['titik_id'];
                TitikAssignment::deleteAll('nik = :nik', [':nik' => $userModel->nik]);
                foreach ($assigment as $value) {
                    $newModel = new TitikAssignment;
                    $newModel->titik_id = $value;
                    $newModel->nik =  $userModel->nik;
                    $newModel->created_at =  date('Y-m-d H:i:s');
                    $newModel->save();
                }
               
                Yii::$app->session->setFlash('success', 'Data berhasi diperbaruhi.');

            }else{
                TitikAssignment::deleteAll('nik = :nik', [':nik' => $userModel->nik]);
                 Yii::$app->session->setFlash('success', 'Data berhasi diperbaruhi.');
            }

            return $this->render('titik_assignment', [
                'model' => $model,
                'userModel' => $userModel
            ]);
            
        } else {

            return $this->render('titik_assignment', [
                'model' => $model,
                'userModel' => $userModel
            ]);
        }

    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Users();

        if ($model->load(Yii::$app->request->post())) {
            $model->created_at = date('Y-m-d');
            $model->password_hash =  Yii::$app->security->generatePasswordHash($_POST['Users']['password_hash']);
            $model->auth_key = Yii::$app->security->generateRandomString();
            
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                $model->password_hash = '';
                $model->auth_key='';
                 return $this->render('create', [
                    'model' => $model,
                ]);
            }
            
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
