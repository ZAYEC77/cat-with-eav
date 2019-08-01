<?php

namespace app\modules\product\controllers;

use app\modules\product\models\ProductSearch;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;
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
                'formatData'=>function (ActiveQuery $query, $columns) {
                    $rows = [];
                    $columns[]=['data'=>'id2'];
                    foreach ($query->all() as $obj) {
                        $row = [];
                        foreach ($columns as $column) {
                            if ($column['data']) {
                                $value = ArrayHelper::getValue($obj, $column['data'], null);
                                if (($pos = strrpos($column['data'], '.')) !== false) {
                                    $keys = explode('.', $column['data']);
                                    $a = $value;
                                    foreach (array_reverse($keys) as $key) {
                                        $a = [$key => $a];
                                    }
                                    $row[$keys[0]] = $a[$keys[0]];
                                } else {
                                    $row[$column['data']] = $value;
                                }
                            }
                        }
                        $rows[] = $row;
                    }

                    return $rows;
                },
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
