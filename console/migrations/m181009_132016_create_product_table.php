<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product`.
 */
class m181009_132016_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'short_description' => $this->text(),
            'description' => $this->text(),
            'meta_title' => $this->string(),
            'meta_description' => $this->string(),
            'alias' => $this->string(),
            'price' => $this->integer()->notNull(),
            'code' => $this->integer(),
            'avail' => $this->integer()->defaultValue(1),
            'unlimited' => $this->integer()->defaultValue(0),
            'count' => $this->integer(),
            'sale' => $this->integer(),
            'hot' => $this->integer()->defaultValue(0),
            'new' => $this->integer()->defaultValue(0),
            'rank' => $this->integer()->defaultValue(1),
            'publish' => $this->integer(1)->defaultValue(0),
            'rating' => $this->integer(),
            'reviews_count' => $this->integer(),
            'main_image' => $this->string(),
            'hits' => $this->integer()->defaultValue(0),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('product');
    }
}
