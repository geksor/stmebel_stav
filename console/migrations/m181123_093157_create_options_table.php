<?php

use yii\db\Migration;

/**
 * Handles the creation of table `options`.
 */
class m181123_093157_create_options_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('options', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'type' => $this->integer(),
            'allCats' => $this->integer(),
            'rank' => $this->integer()->defaultValue(1),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('options');
    }
}
