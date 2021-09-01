<?php
use yii\helpers\Html;
use app\models\ClassDetails;
use yii\widgets\ActiveForm;
use app\models\School;

$this->title = 'Class Details - ' . Html::encode( $model->room ) . ' - ' . Html::encode( $model->period );

// Add relevant info to the page title and nav breadcrumbs.
$this->params[ 'breadcrumbs' ][] = 'Class Details';

?>

<div class="site-exposure">
	<h1>Class Details</h1>
	<table>
		<tr>
			<th>School</th>
			<td><?php echo Html::a( School::findOne( $model->school_id )->name, [ 'schools/view', 'id' => $model->school_id ]  ) ?></td>
		</tr>
		<tr>
			<th>Classroom</th>
			<td><?php echo Html::encode( $model->room ) ?></td>
		</tr>
		<tr>
			<th>Period</th>
			<td><?php echo Html::encode( $model->period ) ?></td>
		</tr>
	</table>
</div>

