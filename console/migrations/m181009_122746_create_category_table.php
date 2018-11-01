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
            'categoryType_id' => $this->integer()->defaultValue(0),
            'parent_id' => $this->integer()->defaultValue(0),
            'title' => $this->string()->notNull(),
            'description' => $this->text(),
            'alias' => $this->string(),
            'meta_title' => $this->string(),
            'meta_description' => $this->string(),
            'publish' => $this->integer(1)->defaultValue(0),
        ]);

        // creates index for column `categoryType_id`
        $this->createIndex(
            'idx-category-categoryType_id',
            'category',
            'categoryType_id'
        );

        // add foreign key for table `categoryType`
        $this->addForeignKey(
            'fk-category-categoryType_id',
            'category',
            'categoryType_id',
            'categoryType',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `categoryType`
        $this->dropForeignKey(
            'fk-category-categoryType_id',
            'category'
        );

        // drops index for column `categoryType_id`
        $this->dropIndex(
            'idx-category-categoryType_id',
            'category'
        );

        $this->dropTable('category');
    }
}
