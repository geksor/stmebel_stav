<?php

use yii\db\Migration;

/**
 * Handles adding viewFromMain to table `category`.
 */
class m181127_091148_add_viewFromMain_column_to_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('category', 'view_from_main', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('category', 'view_from_main');
    }
}
