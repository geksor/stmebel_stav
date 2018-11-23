<?php

use yii\db\Migration;

/**
 * Handles the creation of table `attrValue`.
 * Has foreign keys to the tables:
 *
 * - `attributes`
 */
class m181009_131532_create_attrValue_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('attrValue', [
            'id' => $this->primaryKey(),
            'attr_id' => $this->integer()->notNull(),
            'value' => $this->string()->notNull(),
            'rank' => $this->integer()->defaultValue(1),
        ]);

        // creates index for column `attr_id`
        $this->createIndex(
            'idx-attrValue-attr_id',
            'attrValue',
            'attr_id'
        );

        // add foreign key for table `attr`
        $this->addForeignKey(
            'fk-attrValue-attr_id',
            'attrValue',
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
        // drops foreign key for table `attr`
        $this->dropForeignKey(
            'fk-attrValue-attr_id',
            'attrValue'
        );

        // drops index for column `attr_id`
        $this->dropIndex(
            'idx-attrValue-attr_id',
            'attrValue'
        );

        $this->dropTable('attrValue');
    }
}
