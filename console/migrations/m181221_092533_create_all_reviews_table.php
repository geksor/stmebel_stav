<?php

use yii\db\Migration;

/**
 * Handles the creation of table `all_reviews`.
 */
class m181221_092533_create_all_reviews_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('all_reviews', [
            'id' => $this->primaryKey(),
            'user_name' => $this->string()->notNull(),
            'email' => $this->string(),
            'text' => $this->text(),
            'created_at' => $this->integer()->notNull(),
            'done_at' => $this->integer(),
            'publish' => $this->integer()->defaultValue(0),
            'viewed' => $this->integer()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('all_reviews');
    }
}
