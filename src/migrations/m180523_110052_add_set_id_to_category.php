<?php

use app\models\Category;
use yii\db\Migration;

/**
 * Class m180523_110052_add_set_id_to_category
 */
class m180523_110052_add_set_id_to_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(Category::tableName(),'set_id',$this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(Category::tableName(),'set_id');
    }
}
