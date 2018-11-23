<?php

use yii\db\Migration;

/**
 * Handles the creation of table `ewviews`.
 * Has foreign keys to the tables:
 *
 * - `product`
 */
class m181123_071805_create_reviews_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('reviews', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'user_name' => $this->string()->notNull(),
            'email' => $this->string(),
            'text' => $this->text(),
            'created_at' => $this->integer()->notNull(),
            'done_at' => $this->integer(),
            'publish' => $this->integer()->defaultValue(0),
            'viewed' => $this->integer()->defaultValue(0),
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            'idx-ewviews-product_id',
            'reviews',
            'product_id'
        );

        // add foreign key for table `product`
        $this->addForeignKey(
            'fk-ewviews-product_id',
            'reviews',
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
            'fk-ewviews-product_id',
            'reviews'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            'idx-ewviews-product_id',
            'reviews'
        );

        $this->dropTable('reviews');
    }
}
