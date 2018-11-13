<?php

use yii\db\Migration;

/**
 * Handles adding rank to table `category`.
 */
class m181112_050129_add_rank_column_to_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('category', 'rank', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('category', 'rank');
    }
}
