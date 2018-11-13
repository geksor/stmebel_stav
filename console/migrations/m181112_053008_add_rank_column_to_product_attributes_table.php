<?php

use yii\db\Migration;

/**
 * Handles adding rank to table `product_attributes`.
 */
class m181112_053008_add_rank_column_to_product_attributes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('product_attributes', 'rank', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('product_attributes', 'rank');
    }
}
