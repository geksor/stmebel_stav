<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category_attr`.
 * Has foreign keys to the tables:
 *
 * - `category`
 * - `attr`
 */
class m181009_131909_create_junction_table_for_category_and_attr_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('category_attr', [
            'category_id' => $this->integer(),
            'attr_id' => $this->integer(),
            'PRIMARY KEY(category_id, attr_id)',
        ]);

        // creates index for column `category_id`
        $this->createIndex(
            'idx-category_attr-category_id',
            'category_attr',
            'category_id'
        );

        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-category_attr-category_id',
            'category_attr',
            'category_id',
            'category',
            'id',
            'CASCADE'
        );

        // creates index for column `attr_id`
        $this->createIndex(
            'idx-category_attr-attr_id',
            'category_attr',
            'attr_id'
        );

        // add foreign key for table `attr`
        $this->addForeignKey(
            'fk-category_attr-attr_id',
            'category_attr',
            'attr_id',
            'attr',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `category`
        $this->dropForeignKey(
            'fk-category_attr-category_id',
            'category_attr'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            'idx-category_attr-category_id',
            'category_attr'
        );

        // drops foreign key for table `attr`
        $this->dropForeignKey(
            'fk-category_attr-attr_id',
            'category_attr'
        );

        // drops index for column `attr_id`
        $this->dropIndex(
            'idx-category_attr-attr_id',
            'category_attr'
        );

        $this->dropTable('category_attr');
    }
}
