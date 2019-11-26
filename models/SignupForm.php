<?php
namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Signup form
 */

class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $password_repeat;
    public $surname;
    public $name;
    public $patronymic;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['surname', 'name', 'patronymic', 'email'], 'trim'],

            [['surname', 'name', 'username', 'email', 'password'], 'required', 'message' => 'Заполните поле'],

            ['username', 'required', 'message' => 'Заполните поле'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Пользователь с таким логином уже зарегистрирован!'],
            ['username', 'string', 'min' => 2, 'max' => 255, 'tooShort' => 'Логин должен содержать минимум 2 символа'],

            ['email', 'email', 'message' => 'Неверная форма E-Mail'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Такой e-mail адрес уже зарегистрирован'],

            ['password', 'string', 'min' => 6, 'tooShort' => 'Пароль должен содержать минимум 6 символов!'],
            ['password', 'match', 'pattern' => '/[a-z]+/i', 'message' => 'Пароль должен содержать символы латиницы!'],
            ['password', 'match', 'pattern' => '/(?=.*[a-z])(?=.*[A-Z])/', 'message' => 'Пароль должен содержать символы верхнего и нижнего регистра!'],
            ['password_repeat', 'required', 'message' => 'Заполните поле'],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>'Пароли не совпадают!'],

        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->surname = $this->surname;
        $user->name = $this->name;
        $user->patronymic = $this->patronymic;
        $user->email = $this->email;
        $user->generateAuthKey();
        $user->setPassword($this->password);
        $user->generatePasswordResetToken();
        $user->generateEmailVerificationToken();
        return $user->save();
    }
}
