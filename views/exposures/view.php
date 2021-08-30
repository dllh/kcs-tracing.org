<?php
use yii\helpers\Html;
use app\models\Exposure;
use yii\widgets\ActiveForm;

$this->title = 'Exposure - ' . Html::encode( $model->room ) . ' - ' . Html::encode( $model->period );

// Add relevant info to the page title and nav breadcrumbs.
$this->params[ 'breadcrumbs' ][] = 'Exposures';

?>

<div class="site-exposure">
	<h1>Class Exposure</h1>
	<table>
		<tr>
			<th>School</th>
			<td><?php echo Html::encode( $model->school_id ) ?></td>
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

