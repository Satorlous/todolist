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
        $model->username = 'user1';
        $model->surname = 'Васильев';
        $model->name = 'Александр';
        $model->patronymic = 'Андреевич';
        $model->email = 'user1@mail.ru';
        $model->generateAuthKey();
        $model->setPassword('123123');
        $model->generateEmailVerificationToken();
        $model->generatePasswordResetToken();
        $model->save();

        $model = new User();
        $model->username = 'user2';
        $model->surname = 'Петров';
        $model->name = 'Альберт';
        $model->patronymic = 'Михайлович';
        $model->email = 'user2@mail.ru';
        $model->generateAuthKey();
        $model->setPassword('123123');
        $model->generateEmailVerificationToken();
        $model->generatePasswordResetToken();
        $model->save();

        $model = new User();
        $model->username = 'user3';
        $model->surname = 'Синицын';
        $model->name = 'Валентин';
        $model->patronymic = 'Валерьевич';
        $model->email = 'user3@mail.ru';
        $model->generateAuthKey();
        $model->setPassword('123123');
        $model->generateEmailVerificationToken();
        $model->generatePasswordResetToken();
        $model->save();

        $model = new User();
        $model->username = 'user4';
        $model->surname = 'Леппик';
        $model->name = 'Никита';
        $model->patronymic = 'Олегович';
        $model->email = 'user4@mail.ru';
        $model->generateAuthKey();
        $model->setPassword('123123');
        $model->generateEmailVerificationToken();
        $model->generatePasswordResetToken();
        $model->save();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        User::deleteAll(['id' => [1,2,3,4]]);
    }
}
