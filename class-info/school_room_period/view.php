<?php
use yii\helpers\Html;
use app\models\SchoolRoomPeriod;
use yii\widgets\ActiveForm;
use app\models\School;

$this->title = 'School - ' . Html::encode( $model->room ) . ' - ' . Html::encode( $model->period );

// Add relevant info to the page title and nav breadcrumbs.
$this->params[ 'breadcrumbs' ][] = 'School Room/Period';

?>

<div class="site-exposure">
	<h1>Room / Period</h1>
	<table>
		<tr>
			<th>School</th>
			<td><?php echo Html::encode( School::findOne( $model->school_id )->name ) ?></td>
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

