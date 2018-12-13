<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order_opt_rb_item`.
 * Has foreign keys to the tables:
 *
 * - `order_opt_rb_sec`
 */
class m181213_072545_create_order_opt_rb_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('order_opt_rb_item', [
            'id' => $this->primaryKey(),
            'section_id' => $this->integer()->notNull(),
            'title' => $this->string(),
            'addPrice' => $this->integer(),
            'rank' => $this->integer(),
        ]);

        // creates index for column `section_id`
        $this->createIndex(
            'idx-order_opt_rb_item-section_id',
            'order_opt_rb_item',
            'section_id'
        );

        // add foreign key for table `order_opt_rb_sec`
        $this->addForeignKey(
            'fk-order_opt_rb_item-section_id',
            'order_opt_rb_item',
            'section_id',
            'order_opt_rb_sec',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `order_opt_rb_sec`
        $this->dropForeignKey(
            'fk-order_opt_rb_item-section_id',
            'order_opt_rb_item'
        );

        // drops index for column `section_id`
        $this->dropIndex(
            'idx-order_opt_rb_item-section_id',
            'order_opt_rb_item'
        );

        $this->dropTable('order_opt_rb_item');
    }
}
