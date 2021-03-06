<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\EmailsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="emails-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'receiver_name') ?>

    <?= $form->field($model, 'receiver_email') ?>

    <?= $form->field($model, 'subject') ?>

    <?= $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'attachment') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'time') ?>

    <?php // echo $form->field($model, 'branches_id') ?>

    <?php // echo $form->field($model, 'companies_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
