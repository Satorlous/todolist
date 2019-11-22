<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%responsible}}`.
 */
class m191122_160148_create_responsible_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%responsible}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'chief_id' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey(
            'FK_responsible_user_id',
            'responsible',
            'user_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addForeignKey(
            'FK_responsible_chief_id',
            'responsible',
            'chief_id',
            'chief',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%responsible}}');
        $this->dropForeignKey('FK_responsible_user_id', '{{%responsible}}');
        $this->dropForeignKey('FK_responsible_chief_id', '{{%responsible}}');
    }
}
