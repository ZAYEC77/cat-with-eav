<?php

namespace app\modules\product;
use nullref\core\interfaces\IAdminModule;
use rmrevin\yii\fontawesome\FA;
use Yii;

/**
 * product module definition class
 */
class Module extends \yii\base\Module implements IAdminModule
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\product\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    /**
     * @return array
     */
    public static function getAdminMenu()
    {
        return [
            'label'=>Yii::t('product','Products'),
            'url'=>['/product/admin'],
            'icon'=>FA::_LIST,
        ];
    }
}
