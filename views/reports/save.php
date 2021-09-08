<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use app\models\School;
use app\models\Report;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use kartik\select2\Select2;

$this->title = 'Report a COVID-19 Case';

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
$allValidGradesForSelect2 = [];
foreach ( School::getValidGrades( 'unspecified' ) as $grade ) {
	$allValidGradesForSelect2[ $grade ] = $grade;
}
$schoolToTypeMap = [];

foreach ( $schools as $school ) {
	$schoolToTypeMap[ $school->id ] = $school->type;
}
?>

<h1>Add COVID-19 Case Report</h1>

<div id="no-duplicate" class="alert"><b>Note:</b> If you reported your child's confirmed case of COVID on <a href="https://docs.google.com/forms/d/e/1FAIpQLSdnh2AZeRI6Np01H84mjMOnUZb1v3D4VqFVZ-Zv_7DM6U6veg/viewform">this Google Form</a>, that report has been transferred to this tool, so please do not create a duplicate report here.</div>

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
			 }',
		],
		'data' => $schoolData,
	     ]
	     )->label( 'Student\'s School' ); 
    ?>


    <?= $form->field($model, 'grade')->widget( Select2::classname(), [ 'language' => 'en', 'options' => [ 'placeholder' => 'Select a grade level...' ], 'pluginOptions' => [ 'allowClear' => true ], 'data' => $allValidGradesForSelect2 ] )->label( 'Student\'s Grade Level' ); ?>

    <?= $form->field( $model, 'symptomatic' )
	     ->checkbox( [
		     	'check'   => 'symptomatic',
			'uncheck' => 'asymptomatic',
			'label'   => '<span>Check this box if your child exhibited symptoms of COVID-19.</span>',
	     ] )
    ?>

    <?= $form->field($model, 'symptomatic_date')->widget(\yii\jui\DatePicker::classname(), [ 'dateFormat' => 'yyyy-MM-dd', ] )->label( 'Symptom Onset Date' ) ?>
    <?= $form->field($model, 'positive_test_date')->widget(\yii\jui\DatePicker::classname(), [ 'dateFormat' => 'yyyy-MM-dd', ] )->label( 'Date of Positive Test (when was the test <b>given</b>?)' ) ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

	     
	     
<?php ActiveForm::end() ?>

    <script type="text/javascript">
	     // If the "symptomatic" checkbox is ticked, show the symptomatic date field. 
	     document.getElementById( 'report-symptomatic' ).onclick = function ( event ) {
		     if ( true === event.target.checked ) {
			     document.getElementsByClassName( 'field-report-symptomatic_date' )[0].classList.add( 'show' );
		     } else {
			     document.getElementsByClassName( 'field-report-symptomatic_date' )[0].classList.remove( 'show' );
		     }
	     } 

    </script>
