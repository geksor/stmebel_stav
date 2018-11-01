<?php

use yii\db\Migration;

/**
 * Handles the creation of table `howWeWorkStep`.
 * Has foreign keys to the tables:
 *
 * - `howWeWork`
 */
class m181009_114022_create_howWeWorkStep_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('howWeWorkStep', [
            'id' => $this->primaryKey(),
            'houWeWork_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'publish' => $this->integer(1)->defaultValue(0),
            'rank' => $this->integer()->defaultValue(1),
        ]);

        // creates index for column `houWeWork_id`
        $this->createIndex(
            'idx-howWeWorkStep-houWeWork_id',
            'howWeWorkStep',
            'houWeWork_id'
        );

        // add foreign key for table `howWeWork`
        $this->addForeignKey(
            'fk-howWeWorkStep-houWeWork_id',
            'howWeWorkStep',
            'houWeWork_id',
            'howWeWork',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `howWeWork`
        $this->dropForeignKey(
            'fk-howWeWorkStep-houWeWork_id',
            'howWeWorkStep'
        );

        // drops index for column `houWeWork_id`
        $this->dropIndex(
            'idx-howWeWorkStep-houWeWork_id',
            'howWeWorkStep'
        );

        $this->dropTable('howWeWorkStep');
    }
}
