<?php
use yii\helpers\Html;
use app\models\BoardMember;
use yii\widgets\ActiveForm;

$this->title = 'Board Member - ' . $model->name;

// Add relevant info to the page title and nav breadcrumbs.
$this->params[ 'breadcrumbs' ][] = 'Schools';

?>

<div class="site-school">
	<h1><?= Html::encode( $model->name ) ?></h1>
	<table>
		<tr>
			<th>Phone</th>
			<td><?php echo Html::encode( $model->phone ) ?></td>
		</tr>
		<tr>
			<th>Email</th>
			<td><?php echo Html::encode( $model->email ) ?></td>
		</tr>
		<tr>
			<th>District</th>
			<td><?php echo Html::encode( $model->district ) ?></td>
		</tr>
	</table>
</div>

