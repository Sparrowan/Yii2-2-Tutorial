<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use backend\models\Branches;
use backend\models\Companies;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Departments */
/* @var $form yii\widgets\ActiveForm */
?>





<div class="departments-form">

    <?php $form = ActiveForm::begin(); ?>

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
    'options'=>['id'=>'departments-branches_id'],
    'pluginOptions'=>[
        'depends'=>['departments-companies_id'],
        'placeholder' => 'Select a Branch...',
        'url'=>Url::to(['/departments/lists'])
    ]
]);

?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive', '' => '', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
