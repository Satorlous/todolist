<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model SignupForm */


use app\models\SignupForm;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1><br>
    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin([
                    'id' => 'form-signup',
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'template' => "{label}\n<div class=\"col-lg-6\">{input}</div>\n<div class=\"col-lg-8 col-lg-offset-2\">{error}</div>",
                        'labelOptions' => ['class' => 'col-lg-2 control-label'],
                    ],
            ]); ?>

                <?= $form->field($model, 'surname')->label('Фамилия')?>

                <?= $form->field($model, 'name')->label('Имя')?>

                <?= $form->field($model, 'patronymic')->label('Отчество')?>

                <?= $form->field($model, 'username')->label('Логин')?>

                <?= $form->field($model, 'email')->label('Электронный адрес')?>

                <?= $form->field($model, 'password')->label('Пароль')->passwordInput() ?>

                <?= $form->field($model, 'password_repeat')->label('Подтверждение пароля')->passwordInput() ?>

                <div class="col-lg-offset-2"><?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?></div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
