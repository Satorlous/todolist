<?
/* @var $responsibles app\models\Responsible */
/* @var $freeUsers app\models\User */

use app\models\Responsible;
use app\models\User;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="row">
    <?if(empty($responsibles) && empty($freeUsers)):?>
    <div class="jumbotron">
        <h1>Здесь пусто :(</h1>
        <div class="lead">У вас нет подчиненных.</div>
        <div class="lead">Нет свободных пользователей.</div>
    </div>
    <?endif;?>
    <!--#region My Responsibles Table-->
    <?if(!empty($responsibles)):?>
    <div class="<?=empty($freeUsers) ? 'col-lg-8 col-lg-offset-2' : 'col-lg-6'?>">
        <h2>Мои подчиненные</h2>
        <div class="table-div">
            <table class="table table-hover table-responsive-sm tasks-table">
                <thead>
                <tr class="purple">
                    <th scope="col">#</th>
                    <th scope="col">ФИО</th>
                </tr>
                </thead>
                <tbody>
                <?$i = 1;foreach($responsibles as $responsible):?>
                    <tr data-toggle="modal" data-target="#remove-responsible-<?=$responsible->id?>">
                        <th scope="row"><?=$i?></th>
                        <td><?=$responsible->user->fullName?></td>
                        <div class="modal fade" id="remove-responsible-<?=$responsible->id?>" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Новый подчиненный</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Выбран пользователь <b>"<?=$responsible->user->fullName?>".</b></p>
                                        <p>Удалить его из списка ваших подчиненных?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                                        <a href="<?=Url::toRoute(['site/remove-responsible', 'id' => $responsible->id])?>" type="button" class="btn btn-primary">Удалить</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tr>
                <?$i++;endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
    <?endif;?>
    <!--#endregion My Responsibles Table-->
    <!--#region Free Users Table-->
    <?if(!empty($freeUsers)):?>
    <div class="<?=empty($responsibles) ? 'col-lg-8 col-lg-offset-2' : 'col-lg-6'?>">
        <h2>Пользователи без руководителя</h2>
        <div class="table-div">
            <table class="table table-hover table-responsive-sm tasks-table">
                <thead>
                <tr class="purple">
                    <th scope="col">#</th>
                    <th scope="col">ФИО</th>
                </tr>
                </thead>
                <tbody>
                <?$i = 1;foreach($freeUsers as $freeUser): ?>
                    <tr data-toggle="modal" data-target="#add-free-user-<?=$freeUser->id?>">
                        <th scope="row"><?=$i?></th>
                        <td><?=$freeUser->fullName?></td>
                        <div class="modal fade" id="add-free-user-<?=$freeUser->id?>" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Новый подчиненный</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Выбран пользователь <b>"<?=$freeUser->fullName?>".</b></p>
                                        <p>Добавить его в список ваших подчиненных?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                                        <a href="<?=Url::toRoute(['site/add-responsible', 'id' => $freeUser->id])?>" type="button" class="btn btn-primary">Добавить</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tr>
                <?$i++;endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
    <?endif;?>
    <!--#endregion Free Users Table-->
</div>