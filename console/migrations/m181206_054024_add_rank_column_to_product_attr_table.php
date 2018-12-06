<?php

use yii\db\Migration;

/**
 * Handles adding rank to table `product_attr`.
 */
class m181206_054024_add_rank_column_to_product_attr_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('product_attr', 'rank', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('product_attr', 'rank');
    }
}
