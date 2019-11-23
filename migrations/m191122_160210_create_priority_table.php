<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%priority}}`.
 */
class m191122_160210_create_priority_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%priority}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);
        $this->insert('{{%priority}}', [
            'id'    => 1,
            'name'  => 'Низкий'
        ]);
        $this->insert('{{%priority}}', [
            'id'    => 2,
            'name'  => 'Средний'
        ]);
        $this->insert('{{%priority}}', [
            'id'    => 3,
            'name'  => 'Высокий'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%priority}}');
    }
}
