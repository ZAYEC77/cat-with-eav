<?php

use app\models\Category;
use nullref\category\helpers\Fancytree;
use nullref\eav\widgets\Attributes;
use wbraganca\fancytree\FancytreeWidget;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\product\models\Product */
/* @var $form yii\widgets\ActiveForm */


$this->registerJs(<<<JS
window.selectTreeNode = function () {
    jQuery('#fancyree_categoriesTree').fancytree("getTree").generateFormElements("Product[categoriesList][]");
};
JS
);

?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->beginField($model, 'categoriesList') ?>
    <?= Html::activeLabel($model, 'categoriesList') ?>
    <?= FancytreeWidget::widget([
        'id' => 'categoriesTree',
        'options' => Fancytree::getOptions([
            'init' => new JsExpression('window.selectTreeNode'),
            'select' => new JsExpression('window.selectTreeNode'),
            'source' => Category::getNestedList($model->categoriesList),
        ])
    ]) ?>
    <?= $form->endField() ?>

    <?= Attributes::widget([
        'form' => $form,
        'model' => $model,
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('product', 'Create') : Yii::t('product', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
