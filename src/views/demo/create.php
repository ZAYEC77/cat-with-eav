<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Demo */

$this->title = Yii::t('product', 'Create Demo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('product', 'Demos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="demo-create">

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <?= Html::encode($this->title) ?>
            </h1>
        </div>
    </div>

    <p>
        <?= Html::a(Yii::t('product', 'List'), ['index'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
