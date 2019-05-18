<?php

namespace app\modules\product\controllers;

use app\modules\product\models\ProductSearch;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `product` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actions()
    {
        return [
            'datatables-ajax' => [
                'class' => 'nullref\datatable\DataTableAction',
                'query' => ProductSearch::find(),
            ],
        ];
    }


    /**
     * @return string
     */
    public function actionDatatable()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->requestedParams);

        return $this->render('datatable', [
            'dataProvider' => $dataProvider,
        ]);
    }

}
