<?php

use app\models\Chief;
use app\models\Responsible;
use app\models\Task;
use yii\db\Migration;

/**
 * Class m191123_142330_insert_test_values_into_tables
 */
class m191123_142330_insert_test_values_into_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $task = new Task();
        $task->header = 'Lorem ipsum dolor';
        $task->description = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores, repudiandae.';
        $task->priority_id = 1;
        $task->status_id = 1;
        $task->responsible_id = 2;
        $task->chief_id = 1;
        $task->expires_at = Yii::$app->formatter->asTimestamp('27.11.2019');
        $task->save();

        $task = new Task();
        $task->header = 'Lorem ipsum dolor';
        $task->description = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores, repudiandae.';
        $task->priority_id = 2;
        $task->status_id = 2;
        $task->responsible_id = 2;
        $task->chief_id = 1;
        $task->expires_at = Yii::$app->formatter->asTimestamp('01.12.2019');
        $task->save();

        $task = new Task();
        $task->header = 'Lorem ipsum dolor';
        $task->description = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores, repudiandae.';
        $task->priority_id = 3;
        $task->status_id = 3;
        $task->responsible_id = 3;
        $task->chief_id = 2;
        $task->expires_at = Yii::$app->formatter->asTimestamp('27.11.2019');
        $task->save();

        $task = new Task();
        $task->header = 'Lorem ipsum dolor';
        $task->description = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores, repudiandae.';
        $task->priority_id = 3;
        $task->status_id = 4;
        $task->responsible_id = 3;
        $task->chief_id = 2;
        $task->expires_at = Yii::$app->formatter->asTimestamp('28.11.2019');
        $task->save();

        $task = new Task();
        $task->header = 'Lorem ipsum dolor';
        $task->description = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores, repudiandae.';
        $task->priority_id = 3;
        $task->status_id = 3;
        $task->responsible_id = 2;
        $task->chief_id = 1;
        $task->expires_at = Yii::$app->formatter->asTimestamp('24.11.2019');
        $task->save();

        $responsible = new Responsible();
        $responsible->chief_id = 1;
        $responsible->user_id = 2;
        $responsible->save();

        $responsible = new Responsible();
        $responsible->chief_id = 2;
        $responsible->user_id = 3;
        $responsible->save();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        Task::deleteAll(['id' => [1,2,3,4,5]]);
        Responsible::deleteAll(['id' => [1,2]]);
    }
}
