<?php

use yii\db\Migration;

/**
 * Handles adding viewOnWidget to table `product`.
 */
class m181112_052829_add_viewOnWidget_column_to_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('product', 'viewOnWidget', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('product', 'viewOnWidget');
    }
}
