<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category_options`.
 * Has foreign keys to the tables:
 *
 * - `category`
 * - `options`
 */
class m181123_093951_create_junction_table_for_category_and_options_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('category_options', [
            'category_id' => $this->integer(),
            'options_id' => $this->integer(),
            'PRIMARY KEY(category_id, options_id)',
        ]);

        // creates index for column `category_id`
        $this->createIndex(
            'idx-category_options-category_id',
            'category_options',
            'category_id'
        );

        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-category_options-category_id',
            'category_options',
            'category_id',
            'category',
            'id',
            'CASCADE'
        );

        // creates index for column `options_id`
        $this->createIndex(
            'idx-category_options-options_id',
            'category_options',
            'options_id'
        );

        // add foreign key for table `options`
        $this->addForeignKey(
            'fk-category_options-options_id',
            'category_options',
            'options_id',
            'options',
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
            'fk-category_options-category_id',
            'category_options'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            'idx-category_options-category_id',
            'category_options'
        );

        // drops foreign key for table `options`
        $this->dropForeignKey(
            'fk-category_options-options_id',
            'category_options'
        );

        // drops index for column `options_id`
        $this->dropIndex(
            'idx-category_options-options_id',
            'category_options'
        );

        $this->dropTable('category_options');
    }
}
