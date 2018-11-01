<?php

use yii\db\Migration;

/**
 * Handles the creation of table `callBack`.
 */
class m181009_120322_create_callBack_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('callBack', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'done_at' => $this->integer(),
            'viewed' => $this->integer(1)->defaultValue(0),
            'name' => $this->string(),
            'phone' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('callBack');
    }
}
