<?php

namespace app\controllers;

use app\models\Demo;
use app\models\DemoSearch;
use nullref\core\interfaces\IAdminController;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * DemoController implements the CRUD actions for Demo model.
 */
class DemoController extends Controller implements IAdminController
{
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
     * @return array
     */
    public function actions()
    {
        return [
            'datatables-ajax' => [
                'class' => 'nullref\datatable\DataTableAction',
                'query' => DemoSearch::find(),
                'extraColumns' => ['fileNameWithUrl'],
            ],
            'datatables-custom-ajax' => [
                'class' => 'nullref\datatable\DataTableAction',
                'query' => (new DemoSearch())->search(Yii::$app->request->queryParams)->query,
                'extraColumns' => ['fileNameWithUrl'],
            ],
        ];
    }

    /**
     * Lists all Demo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DemoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Demo models.
     * @return mixed
     */
    public function actionDt()
    {
        $searchModel = new DemoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('dt', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Lists all Demo models.
     * @return mixed
     */
    public function actionAjaxFiltering()
    {
        $searchModel = new DemoSearch();
        $queryParams = Yii::$app->request->queryParams;
        $dataProvider = $searchModel->search($queryParams);

        return $this->render('ajax-filtering', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'queryParams' => $queryParams,
        ]);
    }

    /**
     * Displays a single Demo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the Demo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Demo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Demo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new Demo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Demo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Demo model.
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
     * Deletes an existing Demo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
}
