<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order`.
 */
class m181213_073719_create_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('order', [
            'id' => $this->primaryKey(),
            'create_at' => $this->integer(),
            'checked_opt' => $this->text(),
            'customer_name' => $this->string(),
            'customer_phone' => $this->integer(),
            'customer_email' => $this->string(),
            'total_price' => $this->integer(),
            'state' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('order');
    }
}
