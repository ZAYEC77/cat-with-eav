<?php

use yii\db\Migration;

/**
 * Handles the creation of table `demo`.
 */
class m190824_201943_create_demo_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('demo', [
            'id' => $this->primaryKey(),
            'filename' => $this->string(),
            'size' => $this->integer(),
            'packed' => $this->boolean(),
            'invalid' => $this->boolean(),
            'createdAt' => $this->dateTime()->defaultExpression('NOW()'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('demo');
    }
}
