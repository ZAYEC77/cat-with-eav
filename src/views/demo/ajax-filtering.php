<?php

/* @var $this yii\web\View */
/* @var $queryParams array */
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

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;

$this->title = 'Demo';

?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <?= Html::encode($this->title) ?>
        </h1>
    </div>
</div>

<div>
    <?php $form = \yii\widgets\ActiveForm::begin([
        'method' => 'get',
    ]) ?>
    <?= $form->field($searchModel, 'filename')->textInput() ?>

    <?= Html::submitButton() ?>
    <?php \yii\widgets\ActiveForm::end() ?>
</div>

<hr>

<?= \nullref\datatable\DataTable::widget([
    'data' => $dataProvider->getModels(),
    'columns' => [
        [
            'data' => 'id', 'title' => Yii::t('common', 'ID'),
        ],
        [
            'data' => 'filename', 'title' => Yii::t('common', 'File Name'),
            'render' => new JsExpression($renderFileNameJs),
        ],
        [
            'data' => 'size', 'title' => Yii::t('common', 'File Size'),
            'render' => new JsExpression($renderFileSizeJs),
        ],
        [
            'data' => 'packed', 'title' => Yii::t('common', 'Packed'),
            'render' => new JsExpression($renderYesNoJs),
        ],
        [
            'data' => 'invalid', 'title' => Yii::t('common', 'Invalid'),
            'render' => new JsExpression($renderYesNoJs),
        ],
        [
            'data' => 'createdAt', 'title' => Yii::t('common', 'Create Time')
        ],
    ],
    'extraColumns' => ['fileNameWithUrl'],
    'serverSide' => true,
    'ajax' => Url::to(array_merge(['/demo/datatables-custom-ajax'], $queryParams)),
    "pagingType" => "full_numbers",
    "order" => new JsExpression("[[ 1, 'asc' ] ]"),
    "lengthMenu" => new JsExpression("[[10,20,50,100],[10,20,50,100]]"),
    "tableOptions" => ["class" => "view-upl-items table table-hover table-condensed "],
    "id" => "tbl_upl_items",
    "globalVariable" => true
]) ?>
