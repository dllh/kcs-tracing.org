<?php
use yii\helpers\Html;
use app\models\Report;
use yii\widgets\ActiveForm;

$this->title = 'Report';

// Add relevant info to the page title and nav breadcrumbs.
$this->params[ 'breadcrumbs' ][] = 'Reports';

$formatter = \Yii::$app->formatter;

?>

<div class="site-exposure">
	<h1>Report</h1>
	<table>
		<tr>
			<th>School</th>
			<td><?php echo Html::a( $model->school->name, [ 'schools/view', 'id' => $model->school_id ]); ?></td>
		</tr>
		<tr>
			<th>Grade Level</th>
			<td><?php echo Html::encode( $model->grade ) ?></td>
		</tr>
		<tr>
			<th>Symptomatic Date</th>
			<td><?php echo Html::encode( $formatter->asDate( $model->symptomatic_date ), 'date' ) ?></td>
		</tr>
		<tr>
			<th>Positive Test Date</th>
			<td><?php echo Html::encode( $formatter->asDate( $model->positive_test_date ), 'date' ) ?></td>
		</tr>
	</table>
</div>

