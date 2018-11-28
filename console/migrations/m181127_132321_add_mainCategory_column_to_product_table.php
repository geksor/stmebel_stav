<?php

use yii\db\Migration;

/**
 * Handles adding mainCategory to table `product`.
 */
class m181127_132321_add_mainCategory_column_to_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('product', 'main_category', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('product', 'main_category');
    }
}
