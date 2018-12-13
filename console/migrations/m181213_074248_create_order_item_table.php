<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order_item`.
 * Has foreign keys to the tables:
 *
 * - `order`
 */
class m181213_074248_create_order_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('order_item', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'title' => $this->string(),
            'attr' => $this->text(),
            'color' =>$this->string(),
            'count' => $this->integer(),
            'price' => $this->integer(),
        ]);

        // creates index for column `order_id`
        $this->createIndex(
            'idx-order_item-order_id',
            'order_item',
            'order_id'
        );

        // add foreign key for table `order`
        $this->addForeignKey(
            'fk-order_item-order_id',
            'order_item',
            'order_id',
            'order',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `order`
        $this->dropForeignKey(
            'fk-order_item-order_id',
            'order_item'
        );

        // drops index for column `order_id`
        $this->dropIndex(
            'idx-order_item-order_id',
            'order_item'
        );

        $this->dropTable('order_item');
    }
}
