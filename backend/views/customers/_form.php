<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Customers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?=  $form->field($model, 'zip_code')->widget(Select2::classname(), [
    'data' => $locations,
    'language' => 'de',
    'options' => ['placeholder' => 'Select a Company ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]); ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'province')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$script = <<< JS
$('#customers-zip_code').change(function(){
var zipId = $(this).val();
$.get('index.php?r=locations/get-city-province',{zipId:zipId},
    function(data){
        var data = $.parseJSON(data);
        $('#customers-city').attr('value',data.city);
        $('#customers-province').attr('value',data.province);
    }
)
});

JS;
$this->registerJs($script);
?>
