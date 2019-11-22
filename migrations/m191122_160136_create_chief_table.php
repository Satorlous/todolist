<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%chief}}`.
 */
class m191122_160136_create_chief_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%chief}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'FK_chief_user_id',
            'chief',
            'user_id',
            'user',
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
        $this->dropTable('{{%chief}}');
        $this->dropForeignKey('FK_chief_user_id', '{{%chief}}');
    }
}
