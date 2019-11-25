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

        $model = new Status();
        $model->name = 'К выполнению';
        $model->save();

        $model = new Status();
        $model->name = 'Выполняется';
        $model->save();

        $model = new Status();
        $model->name = 'Выполнена';
        $model->save();

        $model = new Status();
        $model->name = 'Отменена';
        $model->save();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%status}}');
    }
}
