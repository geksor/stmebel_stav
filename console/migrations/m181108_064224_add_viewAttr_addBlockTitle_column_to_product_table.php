<?php

use yii\db\Migration;

/**
 * Handles adding viewAttr_addBlockTitle to table `product`.
 */
class m181108_064224_add_viewAttr_addBlockTitle_column_to_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('product', 'viewAttr', $this->string());
        $this->addColumn('product', 'addBlockTitle', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('product', 'viewAttr');
        $this->dropColumn('product', 'addBlockTitle');
    }
}
