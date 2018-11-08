<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product_attributes`.
 * Has foreign keys to the tables:
 *
 * - `product`
 * - `attributes`
 */
class m181009_133350_create_junction_table_for_product_and_attributes_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('product_attributes', [
            'product_id' => $this->integer(),
            'attributes_id' => $this->integer(),
            'attrList_id' => $this->integer(),
            'attrColor_id' => $this->string(),
            'attrString' => $this->string(),
            'PRIMARY KEY(product_id, attributes_id)',
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            'idx-product_attributes-product_id',
            'product_attributes',
            'product_id'
        );

        // add foreign key for table `product`
        $this->addForeignKey(
            'fk-product_attributes-product_id',
            'product_attributes',
            'product_id',
            'product',
            'id',
            'CASCADE'
        );

        // creates index for column `attributes_id`
        $this->createIndex(
            'idx-product_attributes-attributes_id',
            'product_attributes',
            'attributes_id'
        );

        // add foreign key for table `attributes`
        $this->addForeignKey(
            'fk-product_attributes-attributes_id',
            'product_attributes',
            'attributes_id',
            'attributes',
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
            'fk-product_attributes-product_id',
            'product_attributes'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            'idx-product_attributes-product_id',
            'product_attributes'
        );

        // drops foreign key for table `attributes`
        $this->dropForeignKey(
            'fk-product_attributes-attributes_id',
            'product_attributes'
        );

        // drops index for column `attributes_id`
        $this->dropIndex(
            'idx-product_attributes-attributes_id',
            'product_attributes'
        );

        $this->dropTable('product_attributes');
    }
}
