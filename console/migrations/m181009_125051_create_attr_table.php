<?php

use yii\db\Migration;

/**
 * Handles the creation of table `attributes`.
 */
class m181009_125051_create_attr_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('attr', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'all_cats' => $this->integer()->defaultValue(0),
            'rank' => $this->integer()->defaultValue(1),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('attr');
    }
}
