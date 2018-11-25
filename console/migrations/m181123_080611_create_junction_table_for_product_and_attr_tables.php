<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product_attr`.
 * Has foreign keys to the tables:
 *
 * - `product`
 * - `attr`
 */
class m181123_080611_create_junction_table_for_product_and_attr_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('product_attr', [
            'product_id' => $this->integer(),
            'attr_id' => $this->integer(),
            'attrValue_id' => $this->integer()->notNull(),
            'PRIMARY KEY(product_id, attr_id, attrValue_id)',
            'price_mod' => $this->integer()->notNull(),
            'add_price' => $this->integer()->notNull(),
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            'idx-product_attr-product_id',
            'product_attr',
            'product_id'
        );

        // add foreign key for table `product`
        $this->addForeignKey(
            'fk-product_attr-product_id',
            'product_attr',
            'product_id',
            'product',
            'id',
            'CASCADE'
        );

        // creates index for column `attr_id`
        $this->createIndex(
            'idx-product_attr-attr_id',
            'product_attr',
            'attr_id'
        );

        // add foreign key for table `attr`
        $this->addForeignKey(
            'fk-product_attr-attr_id',
            'product_attr',
            'attr_id',
            'attr',
            'id',
            'CASCADE'
        );

        // creates index for column `attrValue_id`
        $this->createIndex(
            'idx-product_attr-attrValue_id',
            'product_attr',
            'attr_id'
        );

        // add foreign key for table `attrValue`
        $this->addForeignKey(
            'fk-product_attr-attrValue_id',
            'product_attr',
            'attrValue_id',
            'attrValue',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `product`
        $this->dropForeignKey(
            'fk-product_attr-product_id',
            'product_attr'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            'idx-product_attr-product_id',
            'product_attr'
        );

        // drops foreign key for table `attr`
        $this->dropForeignKey(
            'fk-product_attr-attr_id',
            'product_attr'
        );

        // drops index for column `attr_id`
        $this->dropIndex(
            'idx-product_attr-attr_id',
            'product_attr'
        );

        // drops foreign key for table `attrValue`
        $this->dropForeignKey(
            'fk-product_attr-attrValue_id',
            'product_attr'
        );

        // drops index for column `attrValue_id`
        $this->dropIndex(
            'idx-product_attr-attrValue_id',
            'product_attr'
        );

        $this->dropTable('product_attr');
    }
}
