<?
/* @var $responsibles app\models\Responsible */

use app\models\Responsible;
use app\models\User;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="row">
    <div class="col-lg-6">
        <h2>Мои подчиненные</h2>
        <!--#region Task Table-->
        <div class="table-div">
            <table class="table table-hover table-responsive-sm tasks-table">
                <thead>
                <tr class="info">
                    <th scope="col">#</th>
                    <th scope="col">ФИО</th>
                </tr>
                </thead>
                <tbody>
                <?foreach($responsibles as $responsible): $responsible=$responsible->user; $i = 1;?>
                    <tr>
                        <th scope="row"><?=$i?></th>
                        <td><?=$responsible->fullName?></td>
                    </tr>
                <?endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>