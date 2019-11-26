<?php

/* @var $this yii\web\View */

use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'ToDo-List';
?>
<div class="site-index">
    <div class="jumbotron">
        <h1>Добро пожаловать!</h1>
        <?if(Yii::$app->user->isGuest):?>
            <p class="lead">Для начала работы войдите или зарегистрируйтесь.</p>
        <?else:?>
            <p class="lead">Перейти к <?=Html::a('выданным', Url::toRoute(['site/tasks', 'sort_param' => 'issued']))?> / <?=Html::a('полученным', Url::toRoute(['site/tasks', 'sort_param' => 'received']))?> задачам</p>
            <?$chief = User::findOne(Yii::$app->user->id)->getChief();
            if($chief != null):?>
                <h2>Ваш руководитель: <span><?=$chief->fullName?></span></h2>
            <?endif;?>
        <?endif;?>
    </div>

</div>
