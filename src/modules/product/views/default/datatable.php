<?php
/**
 * @author    Dmytro Karpovych
 * @copyright 2019 NRE
 *
 * @var \yii\data\ActiveDataProvider $dataProvider
 */
use yii\web\JsExpression;

$customColumnRender = <<<JS
function render(data, type, row, meta ){
    return "ID: " + row["id"] + ", Price: " + row["price"];
}
JS;
?>

<?= \nullref\datatable\DataTable::widget([
    'data' => $dataProvider->getModels(),
    'id' => 'dataTable1',
    'globalVariable' => true,
    'columns' => [
        'id',
        'price',
        [
            'title' => 'Custom column',
            'render' => new JsExpression($customColumnRender),
        ],
    ],
]) ?>

