<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product_options`.
 * Has foreign keys to the tables:
 *
 * - `product`
 * - `options`
 */
class m181123_094253_create_junction_table_for_product_and_options_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('product_options', [
            'product_id' => $this->integer(),
            'options_id' => $this->integer(),
            'PRIMARY KEY(product_id, options_id)',
            'optionsValue_id' => $this->integer(),
            'options_value' => $this->string(),
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            'idx-product_options-product_id',
            'product_options',
            'product_id'
        );

        // add foreign key for table `product`
        $this->addForeignKey(
            'fk-product_options-product_id',
            'product_options',
            'product_id',
            'product',
            'id',
            'CASCADE'
        );

        // creates index for column `options_id`
        $this->createIndex(
            'idx-product_options-options_id',
            'product_options',
            'options_id'
        );

        // add foreign key for table `options`
        $this->addForeignKey(
            'fk-product_options-options_id',
            'product_options',
            'options_id',
            'options',
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
            'fk-product_options-product_id',
            'product_options'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            'idx-product_options-product_id',
            'product_options'
        );

        // drops foreign key for table `options`
        $this->dropForeignKey(
            'fk-product_options-options_id',
            'product_options'
        );

        // drops index for column `options_id`
        $this->dropIndex(
            'idx-product_options-options_id',
            'product_options'
        );

        $this->dropTable('product_options');
    }
}
