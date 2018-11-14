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
            'description' => $this->text(),
            'alias' => $this->string(),
            'meta_title' => $this->string(),
            'meta_description' => $this->string(),
            'publish' => $this->integer(1)->defaultValue(0),
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
