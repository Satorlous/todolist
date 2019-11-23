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
            'expires_at'        => time()+3600*24*4
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
            'expires_at'        => time()+3600*27
        ]);

        $this->insert('{{%task}}', [
            'id'                => 3,
            'header'            => 'Lorem ipsum dolor',
            'description'       => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores, repudiandae.',
            'priority_id'       => 3,
            'status_id'         => 3,
            'responsible_id'    => 3,
            'chief_id'          => 1,
            'created_at'        => time()-3600*24*2,
            'updated_at'        => time()-3600*24,
            'expires_at'        => time()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        Task::deleteAll(['id' => [1,2,3,]]);
    }
}
