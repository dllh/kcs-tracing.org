<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use app\models\School;
use app\models\Report;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use kartik\select2\Select2;

/*
 * The code just below is used for some logic that lets us map grade levels to
 * school by classifying each school via its "type" column as a type of school ("high,"
 * "elementary," etc.). We use those classifications in the Schools model and in
 * the select2 js events below within this file to do some magic that causes
 * grades to be limited to the subset of _valid_ grades for the selected school.
 */
$schools = School::find()->orderBy( 'name' )->all();
$schoolData = ArrayHelper::map( $schools, 'id', 'name' );

$validGrades = School::getValidGrades( 'map' );
$schoolToTypeMap = [];

foreach ( $schools as $school ) {
	$schoolToTypeMap[ $school->id ] = $school->type;
}
?>

<h1>Add Report</h1>
<p>Please fill out this form only <b>once per child per infection</b>. We'd like to know both when your child first demonstrated symptoms and when your child had a positive test date.</p>

<script type="text/javascript">
<?php 
	echo 'var schoolToTypeMap = ' . Json::encode( $schoolToTypeMap ) . ";\n"; 
	echo 'var validGradesMap = ' . Json::encode( $validGrades ) . ";\n"; 
?>
</script>


<?php


$form = ActiveForm::begin([
    'id' => 'report-form',
    'options' => ['class' => 'form-vertical'],
]) ?>

    <?= $form->field($model, 'school_id')
	     ->widget( Select2::classname(), 
	     [ 'language' => 'en', 
	    	 'options' => [ 
			 'placeholder' => 'Select a school...' 
		 ], 
		'pluginOptions' => [ 
			'allowClear' => true 
		], 
		'pluginEvents' => [
			'change' => 'function( event ) { 
    				var options = [];
    				var school_id = $( "#report-school_id" ).val();
				var gradeMap = validGradesMap[ schoolToTypeMap[ school_id ] ]; 

				$( "#report-grade option" ).remove();
				$.each( gradeMap, function( idx, grade ) {
					var newOption = new Option( grade, grade, false, false);
					$("#report-grade" ).append( newOption ).trigger( "change" );
				} );

			 }'
		],
		'data' => $schoolData,
	     ]
	     )->label( 'Student\'s School' ); 
    ?>


    <?= $form->field($model, 'grade')->widget( Select2::classname(), [ 'language' => 'en', 'options' => [ 'placeholder' => 'Select a grade level...' ], 'pluginOptions' => [ 'allowClear' => true ], 'data' => [ '11' => 11, '12' => 12 ] ] )->label( 'Student\'s Grade Level' ); ?>
    <?= $form->field($model, 'symptomatic_date')->widget(\yii\jui\DatePicker::classname(), [ 'dateFormat' => 'yyyy-MM-dd', ] )->label( 'Symptom Onset Date' ) ?>
    <?= $form->field($model, 'positive_test_date')->widget(\yii\jui\DatePicker::classname(), [ 'dateFormat' => 'yyyy-MM-dd', ] )->label( 'Date of Positive Test (when was the test <b>given</b>?)' ) ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>
