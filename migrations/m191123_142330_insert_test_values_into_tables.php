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
        $this->insert('{{%task}}', [
            'id'                => 1,
            'header'            => 'Lorem ipsum dolor',
            'description'       => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores, repudiandae.',
            'priority_id'       => 1,
            'status_id'         => 1,
            'responsible_id'    => 2,
            'chief_id'          => 1,
            'created_at'        => time(),
            'updated_at'        => time(),
            'expires_at'        => Yii::$app->formatter->asTimestamp('27.11.2019'),
        ]);

        $this->insert('{{%task}}', [
            'id'                => 2,
            'header'            => 'Lorem ipsum dolor',
            'description'       => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores, repudiandae.',
            'priority_id'       => 2,
            'status_id'         => 2,
            'responsible_id'    => 2,
            'chief_id'          => 1,
            'created_at'        => time(),
            'updated_at'        => time(),
            'expires_at'        => Yii::$app->formatter->asTimestamp('01.12.2019'),
        ]);

        $this->insert('{{%task}}', [
            'id'                => 4,
            'header'            => 'Lorem ipsum dolor',
            'description'       => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores, repudiandae.',
            'priority_id'       => 3,
            'status_id'         => 3,
            'responsible_id'    => 3,
            'chief_id'          => 2,
            'created_at'        => time()-3600*24*2,
            'updated_at'        => time()-3600*24,
            'expires_at'        => Yii::$app->formatter->asTimestamp('27.11.2019'),
        ]);

        $this->insert('{{%task}}', [
            'id'                => 5,
            'header'            => 'Lorem ipsum dolor',
            'description'       => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores, repudiandae.',
            'priority_id'       => 3,
            'status_id'         => 4,
            'responsible_id'    => 3,
            'chief_id'          => 2,
            'created_at'        => time()-3600*24,
            'updated_at'        => time()-3600*25,
            'expires_at'        => Yii::$app->formatter->asTimestamp('27.11.2019'),
        ]);

        $this->insert('{{%task}}', [
            'id'                => 3,
            'header'            => 'Lorem ipsum dolor',
            'description'       => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores, repudiandae.',
            'priority_id'       => 3,
            'status_id'         => 3,
            'responsible_id'    => 2,
            'chief_id'          => 1,
            'created_at'        => time(),
            'updated_at'        => time()+3600*2,
            'expires_at'        => Yii::$app->formatter->asTimestamp('27.11.2019'),
        ]);

        $this->insert('{{%responsible}}', [
            'id'                => 1,
            'chief_id'          => 1,
            'user_id'           => 2,
        ]);
        $this->insert('{{%responsible}}', [
            'id'                => 2,
            'chief_id'          => 2,
            'user_id'           => 3,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        Task::deleteAll(['id' => [1,2,3,]]);
        Responsible::deleteAll(['id' => [1,2]]);
    }
}
