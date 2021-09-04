<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use app\models\School;
use app\models\Report;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

?>

<h1>Save Report</h1>

<?php

$schoolData = ArrayHelper::map( School::find()->orderBy( 'name' )-> all(), 'id', 'name' );
$form = ActiveForm::begin([
    'id' => 'report-form',
    'options' => ['class' => 'form-vertical'],
]) ?>

    <?= $form->field($model, 'school_id')->widget( Select2::classname(), [ 'language' => 'en', 'options' => [ 'placeholder' => 'Select a school...' ], 'pluginOptions' => [ 'allowClear' => true ], 'data' => $schoolData ] )->label( 'Student\'s School' ); ?>
    <?= $form->field($model, 'grade')->widget( Select2::classname(), [ 'language' => 'en', 'options' => [ 'placeholder' => 'Select a grade...' ], 'pluginOptions' => [ 'allowClear' => true ], 'data' => [ 'Pre-K' => 'Pre-K', 'K' => 'K', '1' => 1, '2' => 2, '3' => 3, '4' => 4, '5' => 5, '6' => 6, '7' => 7, '8' => 8, '9' => 9, '10' => 10, '11' => 11, '12' => 12 ] ] )->label( 'Student\'s Grade Level' ); ?>
    <?= $form->field($model, 'symptomatic_date')->widget(\yii\jui\DatePicker::classname(), [ 'dateFormat' => 'yyyy-MM-dd', ] ) ?>
    <?= $form->field($model, 'positive_test_date')->widget(\yii\jui\DatePicker::classname(), [ 'dateFormat' => 'yyyy-MM-dd', ] ) ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>
