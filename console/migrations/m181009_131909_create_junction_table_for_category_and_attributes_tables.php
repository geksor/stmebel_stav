<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category_attributes`.
 * Has foreign keys to the tables:
 *
 * - `category`
 * - `attributes`
 */
class m181009_131909_create_junction_table_for_category_and_attributes_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('category_attributes', [
            'category_id' => $this->integer(),
            'attributes_id' => $this->integer(),
            'PRIMARY KEY(category_id, attributes_id)',
        ]);

        // creates index for column `category_id`
        $this->createIndex(
            'idx-category_attributes-category_id',
            'category_attributes',
            'category_id'
        );

        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-category_attributes-category_id',
            'category_attributes',
            'category_id',
            'category',
            'id',
            'CASCADE'
        );

        // creates index for column `attributes_id`
        $this->createIndex(
            'idx-category_attributes-attributes_id',
            'category_attributes',
            'attributes_id'
        );

        // add foreign key for table `attributes`
        $this->addForeignKey(
            'fk-category_attributes-attributes_id',
            'category_attributes',
            'attributes_id',
            'attributes',
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
            'fk-category_attributes-category_id',
            'category_attributes'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            'idx-category_attributes-category_id',
            'category_attributes'
        );

        // drops foreign key for table `attributes`
        $this->dropForeignKey(
            'fk-category_attributes-attributes_id',
            'category_attributes'
        );

        // drops index for column `attributes_id`
        $this->dropIndex(
            'idx-category_attributes-attributes_id',
            'category_attributes'
        );

        $this->dropTable('category_attributes');
    }
}
