<?php

use yii\db\Migration;

/**
 * Handles the creation of table `categoryType`.
 */
class m181009_122549_create_categoryType_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('categoryType', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('categoryType');
    }
}
