<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\jui\DatePicker;
use app\models\School;
use app\models\Report;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

?>

<h1>Search Reports</h1>

<?php

$schoolData = ArrayHelper::map( School::find()->orderBy( 'name' )-> all(), 'id', 'name' );

$classes = [ 'form-vertical' ];
if ( $hasSearch ) {
	$classes[] = 'searched';
}
$class = implode( ' ', $classes );

$form = ActiveForm::begin([
	'id' => 'report-search-form',
	'method' => 'get',
	'options' => [ 'class' => $class ],
]) ?>

    <?= $form->field( $searchModel, 'school_id')->widget( Select2::classname(), [ 'language' => 'en', 'options' => [ 'placeholder' => 'Select a school...' ], 'pluginOptions' => [ 'allowClear' => true ], 'data' => $schoolData ] )->label( 'Student\'s School' ); ?>
    <?= $form->field( $searchModel, 'grade')->widget( Select2::classname(), [ 'language' => 'en', 'options' => [ 'placeholder' => 'Select a grade...' ], 'pluginOptions' => [ 'allowClear' => true ], 'data' => [ 'Pre-K' => 'Pre-K', 'K' => 'K', '1' => 1, '2' => 2, '3' => 3, '4' => 4, '5' => 5, '6' => 6, '7' => 7, '8' => 8, '9' => 9, '10' => 10, '11' => 11, '12' => 12 ] ] )->label( 'Student\'s Grade Level' ); ?>
    <?= $form->field( $searchModel, 'start_date')->widget(\yii\jui\DatePicker::classname(), [ 'dateFormat' => 'yyyy-MM-dd', ] )->label( 'Search Start Date' ) ?>
    <?= $form->field( $searchModel, 'end_date')->widget(\yii\jui\DatePicker::classname(), [ 'dateFormat' => 'yyyy-MM-dd', ] )->label( 'Search End Date' ) ?>

    <div class="form-group">
        <div c_class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>


<?php 

if ( $hasSearch ) {
	echo GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			'school.name',
			'grade',
			'new_case_date',	
		],
	]);
}

?>
