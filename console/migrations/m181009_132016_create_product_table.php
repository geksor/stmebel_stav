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
            'short_description' => $this->string(),
            'description' => $this->text(),
            'alias' => $this->string(),
            'rank' => $this->integer()->defaultValue(1),
            'publish' => $this->integer(1)->defaultValue(0),
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
