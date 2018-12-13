<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order_opt_checkbox`.
 */
class m181213_070651_create_order_opt_checkbox_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('order_opt_checkbox', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'addPrice' => $this->integer(),
            'rank' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('order_opt_checkbox');
    }
}
