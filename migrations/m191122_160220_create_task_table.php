<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%task}}`.
 */
class m191122_160220_create_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%task}}', [
            'id' => $this->primaryKey(),
            'header' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
            'priority_id' => $this->integer()->notNull(),
            'status_id' => $this->integer()->notNull(),
            'responsible_id' => $this->integer()->notNull(),
            'chief_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'expires_at' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('FK_task_priority_id', 'task', 'priority_id', 'priority', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('FK_task_status_id', 'task', 'status_id', 'status', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('FK_task_responsible_id', 'task', 'responsible_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('FK_task_chief_id', 'task', 'chief_id', 'user', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_task_responsible_id', '{{%task}}');
        $this->dropForeignKey('FK_task_status_id', '{{%task}}');
        $this->dropForeignKey('FK_task_priority_id', '{{%task}}');
        $this->dropForeignKey('FK_task_chief_id', '{{%task}}');
        $this->dropTable('{{%task}}');
    }
}
