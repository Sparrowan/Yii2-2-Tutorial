<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Companies;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $model backend\models\Branches */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="branches-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?=  $form->field($model, 'companies_id')->widget(Select2::classname(), [
    'data' => $companies,
    'language' => 'de',
    'options' => ['placeholder' => 'Select a Company ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
<?=  $form->field($model, 'status')->widget(Select2::classname(), [
    'data' => [ 'active' => 'Active', 'inactive' => 'Inactive', ],
    'language' => 'de',
    'options' => ['placeholder' => 'Select Status ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]); ?>

</div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
