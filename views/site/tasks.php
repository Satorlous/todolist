<?php

/* @var $tasks app\models\Task */

$type = Yii::$app->request->get('type');
$sort_param = Yii::$app->request->get('sort_param');
$this->title = $type == 'received' ? 'Полученные задачи' : $type == 'issued' ? 'Выданные задачи' : 'Задачи';
$this->params['breadcrumbs'][] = $this->title;

use app\models\Priority;
use app\models\Responsible;
use app\models\Status;
use app\models\Task;
use app\models\User;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="site-tasks">
    <h2><?=$this->title?></h2>
    <!--#region Sort Buttons Block-->
    <div class="sort-div">
        <div class="row">
            <div class="col-xs-6">
                <div class="input-group">
                    <span class="sort-div__label input-group-addon">Группировать по дате:</span>
                    <div class="input-group-btn sort-div__btn-group" role="group">
                        <a href="<?=Url::toRoute(['site/tasks', 'sort_param' => 'day', 'type' => $type])?>" type="button" class="btn <?=$sort_param == 'day' ? 'btn-primary' : 'btn-default'?>" data-value="1">На сегодня</a>
                        <a href="<?=Url::toRoute(['site/tasks', 'sort_param' => 'week', 'type' => $type])?>" type="button" class="btn <?=$sort_param == 'week' ? 'btn-primary' : 'btn-default'?>" data-value="2">На неделю</a>
                        <a href="<?=Url::toRoute(['site/tasks', 'sort_param' => 'future', 'type' => $type])?>" type="button" class="btn <?=$sort_param == 'future' ? 'btn-primary' : 'btn-default'?>" data-value="3">На будущее</a>
                        <a href="<?=Url::toRoute(['site/tasks', 'type' => $type])?>" type="button" class="btn btn-warning" data-value="4">Отменить</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xs-12">
                <button class="btn btn-success float-right" data-toggle="modal" data-target="#modal-task-create"><span class="glyphicon glyphicon-plus" aria-hidden="true"> </span> Новая задача</button>
            </div>
        </div>
    </div>
    <!--#endregion Sort Buttons Block-->
    <div class="row">
        <div class="col-lg-12">
            <!--#region Task Table-->
            <div class="table-div">
                <table class="table table-hover table-responsive-sm tasks-table">
                    <thead>
                        <tr class="info">
                            <th scope="col">#</th>
                            <th scope="col">Заголовок</th>
                            <th scope="col">Приоритет</th>
                            <th scope="col">Дата окончания</th>
                            <?if($type == 'issued'):?><th scope="col">Ответственный</th><?endif;?>
                            <th scope="col">Статус</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?$i=1; foreach($tasks as $task):?>
                        <!--#region TASK ROW-->
                        <tr data-toggle="modal" data-target="#modal-task-<?=$task->id?>"
                            <?
                            if($task->expires_at+3600*24 < time() && $task->status->id != 3) //добавление 3600*24 для включения суток на выполенине задачи (задача заканчивается не в начале суток, а в коцне)
                                echo "class='danger'";
                            elseif($task->status->id === 3)
                                echo "class='success'";
                            else
                                echo "class='active'";
                            ?>
                        >
                            <th scope="row"><?=$i?></th>
                            <td><?=$task->header?></td>
                            <td><?=$task->priority->name?></td>
                            <td><?=Yii::$app->formatter->asDate($task->expires_at, 'dd.MM.yyyy')?></td>
                            <?if($type == 'issued'):?><td><?=$task->responsible->fullName?></td><?endif;?>
                            <td><?=$task->status->name?></td>
                            <!--#region EDIT MODAL WINDOW-->
                            <div class="modal fade" id="modal-task-<?=$task->id?>" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" style="display: inline"><?=$task->header?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form class="form-horizontal" action="<?=Url::toRoute(['site/update-task', 'id'=>$task->id])?>" method="post">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <?=Html::hiddenInput(Yii::$app->getRequest()->csrfParam, Yii::$app->getRequest()->getCsrfToken(), []);?>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon modal-task-addon">Заголовок</div>
                                                                <input type="text" name="Task[header]" class="form-control" value="<?=$task->header?>" <?=$task->setDisabledInputIfNotChief()?>>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon modal-task-addon">Описание</div>
                                                                <textarea type="text" name="Task[description]" class="form-control" <?=$task->setDisabledInputIfNotChief()?>><?=$task->description?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon modal-task-addon">Приоритет</div>
                                                                <select class="form-control" name="Task[priority_id]" <?=$task->setDisabledInputIfNotChief()?>>
                                                                    <?foreach(Priority::find()->all() as $priority):?>
                                                                        <option value="<?=$priority->id?>" <?if($priority->id == $task->priority->id) echo 'selected';?>><?=$priority->name?></option>
                                                                    <?endforeach;?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon modal-task-addon">Ответственный</div>
                                                                <select type="text" name="Task[responsible_id]" class="form-control" <?=$task->setDisabledInputIfNotChief()?>>
                                                                    <?foreach(Responsible::find()->where(['chief_id' => Yii::$app->user->id])->all() as $responsible):?>
                                                                        <option value="<?=$responsible->user->id?>" <?if($responsible->user->id == $task->responsible->id) echo 'selected';?>><?=$responsible->user->fullName?></option>
                                                                    <?endforeach;?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon modal-task-addon">Дата окончания</div>
                                                                <input type="date" name="Task[expires_at]" class="form-control" value="<?=Yii::$app->formatter->asDate($task->expires_at, 'yyyy-MM-dd')?>" <?=$task->setDisabledInputIfNotChief()?>>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon modal-task-addon">Статус</div>
                                                                <select  class="form-control" name="Task[status_id]">
                                                                    <?foreach(Status::find()->all() as $status):?>
                                                                        <option value="<?=$status->id?>" <?if($status->id == $task->status->id) echo 'selected';?>><?=$status->name?></option>
                                                                    <?endforeach;?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                                                <button type="submit" class="btn btn-primary">Сохранить</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--#endregion EDIT MODAL WINDOW-->
                        </tr>
                        <!--#endregion TASK ROW-->
                    <?$i++; endforeach;?>
                    <tr><!--#region CREATE MODAL WINDOW-->
                        <div class="table-cell">
                            <div class="modal fade" id="modal-task-create" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" style="display: inline">Новая задача</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <?php $form = ActiveForm::begin([
                                            'id' => 'form-task-new',
                                            'layout' => 'horizontal',
                                            'fieldConfig' => [
                                                'template' => '<div class="input-group"><div class="input-group-addon modal-task-addon">{label}</div>{input}</div><div class="col-xs-12">{error}</div>',
                                                'labelOptions' => ['class' => 'nomargin'],
                                            ],
                                        ]);
                                        ?>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="modal-body">
                                                        <?= $form->field($model, 'header')->label('Заголовок')?>

                                                        <?= $form->field($model, 'description')->textarea(['rows' => '2'])->label('Описание') ?>

                                                        <?= $form->field($model, 'priority_id')->dropDownList(
                                                            ArrayHelper::map(Priority::find()->all(), 'id', 'name'), ['prompt' => 'Выберите приоритет'])->label('Приоритет')
                                                        ?>
                                                        <?= $form->field($model, 'responsible_id')->dropDownList(
                                                            ArrayHelper::map(Responsible::find()->where(['chief_id' => Yii::$app->user->id])->all(), 'userId', 'userName'), ['prompt' => 'Выберите ответственного'])->label('Ответственный')
                                                        ?>
                                                        <div class="form-group field-taskform-expires_at required">
                                                            <div class="input-group">
                                                                <div class="input-group-addon modal-task-addon">Дата окончания</div>
                                                                <input id="taskform-expires_at" type="date" name="TaskForm[expires_at]" class="form-control" min="<?=Yii::$app->formatter->asDate(time(), 'yyyy-MM-dd')?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                                                <button type="submit" class="btn btn-primary">Сохранить</button>
                                            </div>
                                        <?php ActiveForm::end(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--#endregion CREATE MODAL WINDOW--></tr>
                    </tbody>
                </table>
            </div>
            <!--#endregion Task Table-->
        </div>
    </div>
</div>
