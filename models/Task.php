<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $header
 * @property string $description
 * @property int $priority_id
 * @property int $status_id
 * @property int $responsible_id
 * @property int $chief_id
 * @property int $created_at
 * @property int $updated_at
 * @property int $expires_at
 *
 * @property Priority $priority
 * @property Status $status
 * @property User $responsible
 * @property User $chief
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['header', 'description', 'priority_id', 'status_id', 'responsible_id', 'chief_id', 'expires_at'], 'required'],
            [['priority_id', 'responsible_id', 'chief_id', 'expires_at'], 'default', 'value' => null],
            [['header', 'description'], 'string', 'max' => 255],
            [['priority_id'], 'exist', 'skipOnError' => true, 'targetClass' => Priority::class, 'targetAttribute' => ['priority_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['status_id' => 'id']],
            [['responsible_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['responsible_id' => 'id']],
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
            'header' => 'Header',
            'description' => 'Description',
            'priority_id' => 'Priority ID',
            'status_id' => 'Status ID',
            'responsible_id' => 'Responsible ID',
            'chief_id' => 'Chief ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'expires_at' => 'Expires At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPriority()
    {
        return $this->hasOne(Priority::class, ['id' => 'priority_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponsible()
    {
        return $this->hasOne(User::class, ['id' => 'responsible_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChief()
    {
        return $this->hasOne(User::class, ['id' => 'chief_id']);
    }

    public function setDisabledInputIfNotChief()
    {
        if($this->chief->id != Yii::$app->user->id) echo 'disabled';
    }
}
