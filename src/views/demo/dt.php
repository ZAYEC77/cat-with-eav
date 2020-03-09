<?php

/* @var $this yii\web\View */
/* @var $searchModel app\models\DemoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$renderFileNameJs = <<<EOF1
function(data, type, row, meta) { return row['fileNameWithUrl']; }
EOF1;

$renderFileSizeJs = <<<EOF2
function(data, type, row, meta) { return (data / 1024).toFixed(1) + 'KiB'; }
EOF2;

$renderYesNoJs = <<<EOF3
function(data, type, row, meta) { return data == 0 ? '' : "<span style='color:red;'>是</span>"; }
EOF3;

use yii\helpers\Url;
use yii\web\JsExpression; ?>

<?= \nullref\datatable\DataTable::widget([
    'data' => $dataProvider->getModels(),
    'withColumnFilter' => true,
    'columns' => [
        [
            'data' => 'id', 'title' => Yii::t('common', 'ID'),
            'filter' => false,
        ],
        [
            'data' => 'filename', 'title' => Yii::t('common', 'File Name'),
            'render' => new JsExpression($renderFileNameJs),
        ],
        [
            'data' => 'size',     'title' => Yii::t('common', 'File Size'),
            'filter' => false,
            'render' => new JsExpression($renderFileSizeJs),
        ],
        [
            'data' => 'packed',  'title' => Yii::t('common', 'Packed'),
            'filter' => false,
            'render' => new JsExpression($renderYesNoJs),
        ],
        [
            'data' => 'invalid',  'title' => Yii::t('common', 'Invalid'),
            'filter' => false,
            'render' => new JsExpression($renderYesNoJs),
        ],
        [
            'data' => 'createdAt', 'title' => Yii::t('common', 'Create Time')
        ],
    ],
    'extraColumns' => ['fileNameWithUrl'],
    'serverSide' => true,
    'ajax' => Url::to(['/demo/datatables-ajax',]),
//    'language' => new JsExpression("{'url':'dt_i18n'}"),
//    'scrollX' => false,
//    'scrollY' => false,
    "pagingType" => "full_numbers",
    "order" => new JsExpression("[[ 1, 'asc' ] ]"),
    "lengthMenu" => new JsExpression("[[10,20,50,100],[10,20,50,100]]"),
    "tableOptions" => ["class" => "view-upl-items table table-hover table-condensed "],
    "id" => "tbl_upl_items",
    "globalVariable" => true
]) ?>
