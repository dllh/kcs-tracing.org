<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use app\models\School;
use app\models\Report;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
//use kartik\form\ActiveForm;
//use kartik\builder\TabularForm;

?>

<h1>Save Report</h1>

<?php

$schoolData = ArrayHelper::map( School::find()->orderBy( 'name' )-> all(), 'id', 'name' );
$form = ActiveForm::begin([
    'id' => 'report-form',
    'options' => ['class' => 'form-vertical'],
]) ?>

    <?= $form->field($model, 'school_id')->widget( Select2::classname(), [ 'language' => 'en', 'options' => [ 'placeholder' => 'Select a school...' ], 'pluginOptions' => [ 'allowClear' => true ], 'data' => $schoolData ] ); ?>
    <?= $form->field($model, 'room')->textInput()->label( 'Room Number' ) ?> 
    <?= $form->field($model, 'period')->textInput()->label( 'Class Period' ) ?>
    <?= $form->field($model, 'positive_test_date')->widget(\yii\jui\DatePicker::classname(), [ 'dateFormat' => 'yyyy-MM-dd', ] ) ?>
    <?= $form->field($model, 'zipcode')->textInput()->label( 'Zip Code' ) ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>
