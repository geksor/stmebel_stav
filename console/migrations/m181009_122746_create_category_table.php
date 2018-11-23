<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category`.
 * Has foreign keys to the tables:
 *
 * - `categoryType`
 */
class m181009_122746_create_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer()->defaultValue(0),
            'title' => $this->string()->notNull(),
            'meta_title' => $this->string(),
            'meta_description' => $this->string(),
            'description' => $this->text(),
            'alias' => $this->string(),
            'image' => $this->text(),
            'rank' => $this->integer()->defaultValue(1),
            'publish' => $this->integer()->defaultValue(0),
            'show_opt_to_product_list' => $this->text(),
            'show_opt_to_product_card' => $this->text(),
            'show_opt_to_cart' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('category');
    }
}
