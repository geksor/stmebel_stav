<?php

use yii\db\Migration;

/**
 * Handles adding fromWidget to table `catergory`.
 */
class m181116_095615_add_fromWidget_column_to_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('category', 'fromWidget', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('category', 'fromWidget');
    }
}
