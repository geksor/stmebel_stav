<?php

use yii\db\Migration;

/**
 * Handles the creation of table `attrColor`.
 * Has foreign keys to the tables:
 *
 * - `attributes`
 */
class m181009_131639_create_attrColor_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('attrColor', [
            'id' => $this->primaryKey(),
            'attr_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'color' => $this->string()->notNull(),
        ]);

        // creates index for column `attr_id`
        $this->createIndex(
            'idx-attrColor-attr_id',
            'attrColor',
            'attr_id'
        );

        // add foreign key for table `attributes`
        $this->addForeignKey(
            'fk-attrColor-attr_id',
            'attrColor',
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
            'fk-attrColor-attr_id',
            'attrColor'
        );

        // drops index for column `attr_id`
        $this->dropIndex(
            'idx-attrColor-attr_id',
            'attrColor'
        );

        $this->dropTable('attrColor');
    }
}
