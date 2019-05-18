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
        'price',
        [
            'class' => \nullref\datatable\LinkColumn::class,
            'title' => 'Header title',
            'label' => 'Link title',
            'url' => 'view',
            'data' => 'price',
        ]
    ],
]) ?>

