<?php
use yii\helpers\Html;
use app\models\Report;
use yii\widgets\ActiveForm;

$this->title = 'Report';

// Add relevant info to the page title and nav breadcrumbs.
$this->params[ 'breadcrumbs' ][] = 'Reports';

?>

<div class="site-exposure">
	<h1>Report</h1>
	<table>
		<tr>
			<th>School</th>
			<td><?php echo Html::a( $model->school->name, [ 'schools/view', 'id' => $model->school_id ]); ?></td>
		</tr>
		<tr>
			<th>Classroom</th>
			<td><?php echo Html::encode( $model->room ) ?></td>
		</tr>
		<tr>
			<th>Period</th>
			<td><?php echo Html::encode( $model->period ) ?></td>
		</tr>
		<tr>
			<th>Pos. Test Date</th>
			<td><?php echo Html::encode( $model->positive_test_date ) ?></td>
		</tr>
		<tr>
			<th>Zip Code</th>
			<td><?php echo Html::encode( $model->zipcode ) ?></td>
		</tr>
	</table>
</div>

