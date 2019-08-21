<?php
/**
 * @author    Dmytro Karpovych
 * @copyright 2019 NRE
 *
 * @var \yii\data\ActiveDataProvider $dataProvider
 */

use yii\web\JsExpression;

$customColumnRender1 = <<<JS
function customRender1(data, type, row, meta ){
    return "ID: " + row["id"] + ", Price: " + row["price"];
}
JS;
$customColumnRender2 = <<<JS
function customRender2(data, type, row, meta) {
  return JSON.stringify(row);
}
JS;
$content = [
    'tables' => [
        'tbl1' => [
            'data' => $dataProvider->getModels(),
            'columns' => [
                'id',
                'price'
            ],
        ],
        'tbl2' => [
            'data' => $dataProvider->getModels(),
            'columns' => [
                'id',
                'price'
            ],
        ],
    ],
];
foreach ($content['tables'] as $tableId => $table) {
    $columns = [];
    foreach ($table['columns'] as $key) {
        $column = [
            'data' => $key,
            'title' => $key,
        ];
        $columns[] = $column;
    }

    echo \nullref\datatable\DataTable::widget([
//        'data' => $table['data'],
        'serverSide' => true,
        'ajax' => '/product/default/datatables-ajax',
        'columns' => $columns,
        'globalVariable' => true,
        'paging' => false,
        'ordering' => false,
        'info' => false,
        'withColumnFilter' => true,
        'id' => $tableId,
    ]);
}
?>


<?= \nullref\datatable\DataTable::widget([
    'data' => $dataProvider->getModels(),
    'id' => 'dataTable1',
    'globalVariable' => true,
    'serverSide' => true,
    'ajax' => '/product/default/datatables-ajax',
    'extraColumns' => ['id2'],
    'columns' => [
        'id',
        'price',
        [
            'title' => 'Custom column #1',
            'render' => new JsExpression($customColumnRender1),
        ],
        [
            'title' => 'Custom column #2',
            'render' => new JsExpression($customColumnRender2),
        ],
        [
            'url' => 'test',
            'label' => 'Test link',
            'class' => \nullref\datatable\LinkColumn::class,
        ],
    ],
]) ?>

