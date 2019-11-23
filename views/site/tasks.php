<?php

/* @var $tasks app\models\Task */

$this->title = 'Задачи';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-tasks">
    <h2>Список задач</h2>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-hover table-responsive tasks-table">
                <thead>
                    <tr class="info">
                        <th scope="col">#</th>
                        <th scope="col">Заголовок</th>
                        <th scope="col">Приоритет</th>
                        <th scope="col">Дата окончания</th>
                        <th scope="col">Ответственный</th>
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
                        <td><?=$task->responsible->surname.' '.$task->responsible->name.' '.$task->responsible->patronymic?></td>
                        <td><?=$task->status->name?></td>
                    </tr>
                <?$i++; endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
