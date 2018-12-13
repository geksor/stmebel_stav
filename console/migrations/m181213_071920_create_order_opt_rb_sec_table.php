<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order_opt_rb_sec`.
 */
class m181213_071920_create_order_opt_rb_sec_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('order_opt_rb_sec', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'rank' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('order_opt_rb_sec');
    }
}
