<?php

use yii\db\Migration;

/**
 * Handles the creation of table `weDocs`.
 */
class m181009_122007_create_weDocs_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('weDocs', [
            'id' => $this->primaryKey(),
            'docNameReal' => $this->string(),
            'docNameView' => $this->string()->notNull(),
            'itemImage' => $this->string(),
            'itemDescription' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('weDocs');
    }
}
