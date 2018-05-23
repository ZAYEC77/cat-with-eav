<?php
/**
 * @author    Dmytro Karpovych
 * @copyright 2018 NRE
 */


namespace app\models;


/**
 * Class Category
 * @package app\models
 *
 * @property integer $set_id
 */
class Category extends \nullref\category\models\Category
{
    /**
     * Add rules for set_id
     * @return array
     */
    public function rules()
    {
        return array_merge(parent::rules(),[
            'set_id'=>['set_id','safe']
        ]);
    }

}