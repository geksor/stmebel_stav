<?php

use yii\db\Migration;

/**
 * Handles the creation of table `howWeWork`.
 */
class m181009_113645_create_howWeWork_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('howWeWork', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('howWeWork');
    }
}
