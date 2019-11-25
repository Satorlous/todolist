<?php
namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Signup form
 */

class TaskForm extends Model
{
    public $header;
    public $description;
    public $priority_id;
    public $responsible_id;
    public $expires_at;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['header', 'description', 'priority_id', 'responsible_id', 'expires_at'], 'required', 'message' => 'Заполните поле'],
            [['header', 'description'], 'trim'],
            [['priority_id', 'responsible_id'], 'integer'],
        ];
    }

    public function create()
    {
        if (!$this->validate()) {
            return null;
        }

        $task = new Task();
        $task->header = $this->header;
        $task->description = $this->description;
        $task->priority_id = $this->priority_id;
        $task->responsible_id = $this->responsible_id;
        $task->chief_id = Yii::$app->user->id;
        $task->status_id = 1;
        $task->expires_at = Yii::$app->formatter->asTimestamp($this->expires_at);
        return $task->save();
    }
}
