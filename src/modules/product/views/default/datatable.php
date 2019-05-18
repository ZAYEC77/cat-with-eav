<?php
/**
 * @author    Dmytro Karpovych
 * @copyright 2019 NRE
 *
 * @var \yii\data\ActiveDataProvider $dataProvider
 */

?>

<?= \nullref\datatable\DataTable::widget([
    'data' => $dataProvider->getModels(),
    'id' => 'dataTable1',
    'globalVariable' => true,
    'columns' => [
        [
            'class' => \nullref\datatable\DataTableColumn::class,
            'data' => 'price',
            'sClass' => 'price-cell-class',
        ],
        [
            'class' => \nullref\datatable\LinkColumn::class,
            'title' => 'Header title',
            'label' => 'Link title',
            'sClass' => 'link-cell-class',
            'url' => 'view',
            'data' => 'price',
        ]
    ],
]) ?>

