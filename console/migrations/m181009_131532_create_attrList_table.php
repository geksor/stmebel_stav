<?php

use yii\db\Migration;

/**
 * Handles the creation of table `attrList`.
 * Has foreign keys to the tables:
 *
 * - `attributes`
 */
class m181009_131532_create_attrList_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('attrList', [
            'id' => $this->primaryKey(),
            'attr_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
        ]);

        // creates index for column `attr_id`
        $this->createIndex(
            'idx-attrList-attr_id',
            'attrList',
            'attr_id'
        );

        // add foreign key for table `attributes`
        $this->addForeignKey(
            'fk-attrList-attr_id',
            'attrList',
            'attr_id',
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
        // drops foreign key for table `attributes`
        $this->dropForeignKey(
            'fk-attrList-attr_id',
            'attrList'
        );

        // drops index for column `attr_id`
        $this->dropIndex(
            'idx-attrList-attr_id',
            'attrList'
        );

        $this->dropTable('attrList');
    }
}
