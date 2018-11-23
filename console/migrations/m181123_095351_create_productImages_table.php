<?php

use yii\db\Migration;

/**
 * Handles the creation of table `productImages`.
 * Has foreign keys to the tables:
 *
 * - `product`
 */
class m181123_095351_create_productImages_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('productImages', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'image' => $this->string(),
            'title' => $this->string(),
            'rank' => $this->integer(),
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            'idx-productImages-product_id',
            'productImages',
            'product_id'
        );

        // add foreign key for table `product`
        $this->addForeignKey(
            'fk-productImages-product_id',
            'productImages',
            'product_id',
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
            'fk-productImages-product_id',
            'productImages'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            'idx-productImages-product_id',
            'productImages'
        );

        $this->dropTable('productImages');
    }
}
