<?php

use yii\db\Migration;

/**
 * Handles adding showColor to table `product`.
 */
class m181128_120632_add_showColor_column_to_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('product', 'show_color', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('product', 'show_color');
    }
}
