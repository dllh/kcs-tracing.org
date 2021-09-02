<?php
use yii\helpers\Html;
use app\models\School;
use app\models\BoardMember;
use app\models\Report;
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

	<h2>Positive Case Reports</h2>
	<?php if ( count( $model->reports ) > 0 ) : ?>
		<table>
			<thead>
				<tr>
					<th>Room</th>
					<th>Period</th>
					<th>Date</th>
				</tr>
			</thead>
			<tbody>
		<?php foreach ( $model->reports as $report ) : ?>
				<tr>
					<td><?php echo Html::encode( $report->room ); ?></td>
					<td><?php echo Html::encode( $report->period ); ?></td>
					<td><?php echo Html::encode( $report->positive_test_date ); ?></td>
				</tr>
		<?php endforeach; ?>
			</tbody>
		</table>
	<?php else: ?>
		<p>No positive cases reported so far.</p>
	<?php endif; ?>
</div>

