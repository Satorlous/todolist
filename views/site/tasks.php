<?php

/* @var $tasks app\models\Task */

$this->title = 'Задачи';
$this->params['breadcrumbs'][] = $this->title;

use yii\helpers\Url; ?>

<div class="site-tasks">
    <h2>Список задач</h2>
    <div class="sort-div">
        <div class="row">
            <div class="col-xs-6">
                <div class="input-group">
                    <span class="sort-div__label input-group-addon">Группировать по дате:</span>
                    <div class="input-group-btn sort-div__btn-group" role="group">
                        <a href="<?=Url::toRoute(['site/tasks', 'sort_param' => 'day'])?>" type="button" class="btn btn-default" data-value="1">На сегодня</a>
                        <a href="<?=Url::toRoute(['site/tasks', 'sort_param' => 'week'])?>" type="button" class="btn btn-default" data-value="2">На неделю</a>
                        <a href="<?=Url::toRoute(['site/tasks', 'sort_param' => 'future'])?>" type="button" class="btn btn-default" data-value="3">На будущее</a>
                        <a href="<?=Url::toRoute('site/tasks')?>" type="button" class="btn btn-warning" data-value="4">Отменить</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="table-div">
                <table class="table table-hover table-responsive-sm tasks-table">
                    <thead>
                        <tr class="info">
                            <th scope="col">#</th>
                            <th scope="col">Заголовок</th>
                            <th scope="col">Приоритет</th>
                            <th scope="col">Дата окончания</th>
                            <!--<th scope="col">Ответственный</th>-->
                            <th scope="col">Статус</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?$i=1; foreach($tasks as $task):?>
                        <?
                        if($task->expires_at < time() && $task->status->id != 3)
                            echo "<tr class='danger'>";
                        elseif($task->status->id === 3)
                            echo "<tr class='success'>";
                        else
                            echo "<tr class='active'>";
                        ?>
                            <th scope="row"><?=$i?></th>
                            <td><?=$task->header?></td>
                            <td><?=$task->priority->name?></td>
                            <td><?=Yii::$app->formatter->asDate($task->expires_at, 'dd.MM.yyyy')?></td>
                            <td><?=$task->status->name?></td>
                        </tr>
                    <?$i++; endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
