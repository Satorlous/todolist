<?php

use app\models\Status;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%status}}`.
 */
class m191122_160201_create_status_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%status}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);
        $this->insert('{{%status}}', [
            'id'    => 1,
            'name'  => 'К выполнению'
        ]);
        $this->insert('{{%status}}', [
            'id'    => 2,
            'name'  => 'Выполняется'
        ]);
        $this->insert('{{%status}}', [
            'id'    => 3,
            'name'  => 'Выполнена'
        ]);
        $this->insert('{{%status}}', [
            'id'    => 4,
            'name'  => 'Отменена'
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%status}}');
    }
}
