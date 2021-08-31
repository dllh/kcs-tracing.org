<?php
use yii\helpers\Html;
use app\models\School;
use app\models\BoardMember;
use yii\widgets\ActiveForm;

$this->title = 'School - ' . $model->name;

// Add relevant info to the page title and nav breadcrumbs.
$this->params[ 'breadcrumbs' ][] = 'Schools';

//die( '<pre>' . print_r( $model, true ) . '</pre>' );
?>

<div class="site-school">
	<h1><?= Html::encode( $model->name ) ?></h1>
	<table>
		<tr>
			<th>Phone</th>
			<td><?php echo Html::encode( $model->phone ) ?></td>
		</tr>
		<tr>
			<th>Address</th>
			<td><?php echo Html::encode( $model->address ) ?></td>
		</tr>
		<tr>
			<th>Board Member</th>
			<td><?php echo Html::a( $model->boardMember->name, [ 'board-members/view', 'id' => $model->board_member_id ]); ?></td>
		</tr>
	</table>
</div>

