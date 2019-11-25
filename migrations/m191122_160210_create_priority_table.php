<?php

use app\models\Priority;
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

        $model = new Priority();
        $model->name = 'Низкий';
        $model->save();

        $model = new Priority();
        $model->name = 'Средний';
        $model->save();

        $model = new Priority();
        $model->name = 'Высокий';
        $model->save();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%priority}}');
    }
}
