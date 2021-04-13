<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Emails */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="emails-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'receiver_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'receiver_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'attachment')->fileInput(['maxlength' => true]) ?>

    <?=  $form->field($model, 'companies_id')->widget(Select2::classname(), [
    'data' => $companies,
    'language' => 'de',
    'options' => [
        'placeholder' => 'Select a Company ...',
    ],
    'pluginOptions' => [
        'allowClear' => true
    ],
]); ?>



<?=
$form->field($model, 'branches_id')->widget(DepDrop::classname(), [
    'data' => $branches,
    'type' => DepDrop::TYPE_SELECT2,
    'options'=>['id'=>'emails-branches_id'],
    'pluginOptions'=>[
        'depends'=>['emails-companies_id'],
        'placeholder' => 'Select a Branch...',
        'url'=>Url::to(['/emails/lists'])
    ]
]);

?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
