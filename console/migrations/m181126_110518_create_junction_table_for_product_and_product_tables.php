<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product_product`.
 * Has foreign keys to the tables:
 *
 * - `product`
 */
class m181126_110518_create_junction_table_for_product_and_product_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('recommended_product', [
            'product_id' => $this->integer(),
            'recommProduct_id' => $this->integer(),
            'PRIMARY KEY(product_id, recommProduct_id)',
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            'idx-recommended_product-product_id',
            'recommended_product',
            'product_id'
        );

        // add foreign key for table `product`
        $this->addForeignKey(
            'fk-recommended_product-product_id',
            'recommended_product',
            'product_id',
            'product',
            'id',
            'CASCADE'
        );

        // creates index for column `recommProduct_id`
        $this->createIndex(
            'idx-recommended_product-recommProduct_id',
            'recommended_product',
            'product_id'
        );

        // add foreign key for table `product`
        $this->addForeignKey(
            'fk-recommended_product-recommProduct_id',
            'recommended_product',
            'recommProduct_id',
            'product',
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
            'fk-recommended_product-product_id',
            'recommended_product'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            'idx-recommended_product-product_id',
            'recommended_product'
        );

        // drops foreign key for table `product`
        $this->dropForeignKey(
            'fk-recommended_product-recommProduct_id',
            'recommended_product'
        );

        // drops index for column `recommProduct_id`
        $this->dropIndex(
            'idx-recommended_product-recommProduct_id',
            'recommended_product'
        );

        $this->dropTable('product_product');
    }
}
