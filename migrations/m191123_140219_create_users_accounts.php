<?php

use app\models\User;
use yii\db\Migration;

/**
 * Class m191123_140219_create_users_accounts
 */
class m191123_140219_create_users_accounts extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $model = new User();
        $model->generateAuthKey();
        $model->setPassword('123123');
        $model->generatePasswordResetToken();

        $this->insert('{{%user}}', [
            'id'                   => 1,
            'username'             => 'user1',
            'surname'              => 'Васильев',
            'name'                 => 'Александр',
            'patronymic'           => 'Андреевич',
            'auth_key'             => $model->auth_key,
            'password_hash'        => $model->password_hash,
            'password_reset_token' => $model->password_reset_token,
            'email'                => 'user1@mail.ru',
            'status'               => 10,
            'created_at'           => time(),
            'updated_at'           => time(),
        ]);

        $model = new User();
        $model->generateAuthKey();
        $model->setPassword('123123');
        $model->generatePasswordResetToken();

        $this->insert('{{%user}}', [
            'id'                   => 2,
            'username'             => 'user2',
            'surname'              => 'Петров',
            'name'                 => 'Альберт',
            'patronymic'           => 'Михайлович',
            'auth_key'             => $model->auth_key,
            'password_hash'        => $model->password_hash,
            'password_reset_token' => $model->password_reset_token,
            'email'                => 'user2@mail.ru',
            'status'               => 10,
            'created_at'           => time(),
            'updated_at'           => time(),
        ]);

        $model = new User();
        $model->generateAuthKey();
        $model->setPassword('123123');
        $model->generatePasswordResetToken();

        $this->insert('{{%user}}', [
            'id'                   => 3,
            'username'             => 'user3',
            'surname'              => 'Синицын',
            'name'                 => 'Валентин',
            'patronymic'           => 'Валерьевич',
            'auth_key'             => $model->auth_key,
            'password_hash'        => $model->password_hash,
            'password_reset_token' => $model->password_reset_token,
            'email'                => 'user3@mail.ru',
            'status'               => 10,
            'created_at'           => time(),
            'updated_at'           => time(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        User::deleteAll(['id' => [1,2,3]]);
    }
}
