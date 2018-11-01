<?php

use yii\db\Migration;

/**
 * Handles the creation of table `attributes`.
 */
class m181009_125051_create_attributes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('attributes', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'viewName' => $this->string()->notNull(),
            'type' => $this->integer(1)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('attributes');
    }
}
