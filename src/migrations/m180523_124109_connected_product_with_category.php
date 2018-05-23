<?php

use yii\db\Migration;

/**
 * Class m180523_124109_connected_product_with_category
 */
class m180523_124109_connected_product_with_category extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%product_has_category}}', [
            'category_id' => $this->integer(),
            'product_id' => $this->integer(),
            'PRIMARY KEY(category_id, product_id)',
        ]);

        // creates index for column `category_id`
        $this->createIndex(
            'idx-category_product-category_id',
            '{{%product_has_category}}',
            'category_id'
        );

        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-category_product-category_id',
            '{{%product_has_category}}',
            'category_id',
            '{{%category}}',
            'id',
            'CASCADE'
        );

        // creates index for column `product_id`
        $this->createIndex(
            'idx-category_product-product_id',
            '{{%product_has_category}}',
            'product_id'
        );

        // add foreign key for table `product`
        $this->addForeignKey(
            'fk-category_product-product_id',
            '{{%product_has_category}}',
            'product_id',
            '{{%product}}',
            'id',
            'CASCADE'
        );
    }

    /**
     *
     */
    public function safeDown()
    {
        // drops foreign key for table `category`
        $this->dropForeignKey(
            'fk-category_product-category_id',
            '{{%product_has_category}}'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            'idx-category_product-category_id',
            '{{%product_has_category}}'
        );

        // drops foreign key for table `product`
        $this->dropForeignKey(
            'fk-category_product-product_id',
            '{{%product_has_category}}'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            'idx-category_product-product_id',
            '{{%product_has_category}}'
        );

        $this->dropTable('{{%product_has_category}}');
    }
}
