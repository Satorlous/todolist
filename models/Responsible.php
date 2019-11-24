<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "responsible".
 *
 * @property int $id
 * @property int $user_id
 * @property int $chief_id
 *
 * @property User $user
 * @property User $chief
 */
class Responsible extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'responsible';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'chief_id'], 'required'],
            [['user_id', 'chief_id'], 'default', 'value' => null],
            [['user_id', 'chief_id'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['chief_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['chief_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'chief_id' => 'Chief ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChief()
    {
        return $this->hasOne(User::class, ['id' => 'chief_id']);
    }
}
