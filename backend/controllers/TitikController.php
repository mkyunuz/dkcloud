<?php

namespace backend\controllers;

use Yii;
use backend\models\Titik;
use backend\models\TitikSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\FileDir;
use yii\helpers\FileHelper;

/**
 * TitikController implements the CRUD actions for Titik model.
 */
class TitikController extends Controller
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
     * Lists all Titik models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TitikSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Titik model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Titik model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Titik();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->titik_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Titik model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->titik_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }



    public function actionCreateFolder(){
        $DirModel = new FileDir;
        $default_path = $DirModel->default_path();

        $connection = Yii::$app->getDb();
        $command = $connection->createCommand('select hor.hor_name, area.area_name, titik.titik_name from titik 
                                                JOIN area ON titik.area_id=area.area_id
                                                JOIN hor ON hor.hor_id=area.hor_id');
        $result = $command->queryAll();
        foreach ($result as $key) {
            $path = $key['hor_name'].DIRECTORY_SEPARATOR.$key['area_name'].DIRECTORY_SEPARATOR.$key['titik_name'];
            if (!file_exists( $default_path.$path)) {
                $final_path = $default_path.$path;
                FileHelper::createDirectory($final_path, 0775, true);
            }
        }

    }

    /**
     * Deletes an existing Titik model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Titik model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Titik the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Titik::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
