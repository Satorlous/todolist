<?php

use app\models\User;
use yii\db\Migration;

/**
 * Class m191123_140219_create_admin_account
 */
class m191123_140219_create_admin_and_user_accounts extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $model = new User();
        $model->generateAuthKey();
        $model->setPassword('admin');
        $model->generatePasswordResetToken();

        $this->insert('{{%user}}', [
            'id'                   => 1,
            'username'             => 'admin',
            'surname'              => 'admin',
            'name'                 => 'admin',
            'patronymic'           => 'admin',
            'auth_key'             => $model->auth_key,
            'password_hash'        => $model->password_hash,
            'password_reset_token' => $model->password_reset_token,
            'email'                => 'admin@admin.ru',
            'admin'                => true,
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
            'username'             => 'user1',
            'surname'              => 'Петров',
            'name'                 => 'Альберт',
            'patronymic'           => 'Михайлович',
            'auth_key'             => $model->auth_key,
            'password_hash'        => $model->password_hash,
            'password_reset_token' => $model->password_reset_token,
            'email'                => 'user1@mail.ru',
            'admin'                => false,
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
            'username'             => 'user2',
            'surname'              => 'Синицын',
            'name'                 => 'Валентин',
            'patronymic'           => 'Валерьевич',
            'auth_key'             => $model->auth_key,
            'password_hash'        => $model->password_hash,
            'password_reset_token' => $model->password_reset_token,
            'email'                => 'user2@mail.ru',
            'admin'                => false,
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
