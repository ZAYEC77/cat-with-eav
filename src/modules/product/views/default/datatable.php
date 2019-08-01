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

?>

<?= \nullref\datatable\DataTable::widget([
    'data' => $dataProvider->getModels(),
    'id' => 'dataTable1',
    'globalVariable' => true,
    'serverSide' => true,
    'extraColumns' => ['id2'],
    'ajax' => '/product/default/datatables-ajax',
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

