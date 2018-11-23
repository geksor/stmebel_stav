<?php

use yii\db\Migration;

/**
 * Handles the creation of table `optionsValue`.
 * Has foreign keys to the tables:
 *
 * - `options`
 */
class m181123_093720_create_optionsValue_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('optionsValue', [
            'id' => $this->primaryKey(),
            'options_id' => $this->integer()->notNull(),
            'value' => $this->string(),
        ]);

        // creates index for column `options_id`
        $this->createIndex(
            'idx-optionsValue-options_id',
            'optionsValue',
            'options_id'
        );

        // add foreign key for table `options`
        $this->addForeignKey(
            'fk-optionsValue-options_id',
            'optionsValue',
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
        // drops foreign key for table `options`
        $this->dropForeignKey(
            'fk-optionsValue-options_id',
            'optionsValue'
        );

        // drops index for column `options_id`
        $this->dropIndex(
            'idx-optionsValue-options_id',
            'optionsValue'
        );

        $this->dropTable('optionsValue');
    }
}
