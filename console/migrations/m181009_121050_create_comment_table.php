<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comment`.
 */
class m181009_121050_create_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('comment', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'done_at' => $this->integer(),
            'viewed' => $this->integer()->defaultValue(0),
            'user_name' => $this->string()->notNull(),
            'text' => $this->text(),
            'email' => $this->string(),
            'publish' => $this->integer()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('comment');
    }
}
