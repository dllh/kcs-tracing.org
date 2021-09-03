<?php
use yii\helpers\Html;
use app\models\School;
use app\models\BoardMember;
use app\models\Report;
use yii\widgets\ActiveForm;
use scotthuangzl\googlechart\GoogleChart;

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

	<h3>Daily Positive Test Cases at This School</h3>
	<div class="chart" id="total-daily-cases">
                <?php
                        echo GoogleChart::widget(
                                array(
                                        'visualization' => 'LineChart',
                                        'data' => $model->dailyCases,
                                        'options' => [
                                                'title' => 'Daily Positive Test Cases Reported by Parents, Last 30 Days',
                                                'hAxis.title' => 'Day',
                                                'height' => 300,
                                        ]
                                )
                        );
                ?>
	</div>

	<h3>Positive Test Reports by Date, Period, and Room</h3>
	<b>Instructions</b><br />
	<p>Find the date you're concerned about in the first column. Then move to the second column and the third column to find your child's room and class period. If you see positive case counts for the date in question, it's possible your child has been exposed to COVID. We're showing only the last 30 days worth of data.</p>
	<p><b>Note:</b>This data is voluntarily reported by parents and is only as accurate as the data they submit. You should use it as a very rough guide but should not treat it as rock-solid, irrefutable data or proof of exposure.</p>
	<?php if ( count( $model->reports ) > 0 ) : ?>
		<table>
			<thead>
				<tr>
					<th>Date</th>
					<th>Room</th>
					<th>Period</th>
					<th>Count</th>
				</tr>
			</thead>
			<tbody>
		<?php $last_test_date = ''; ?>
		<?php foreach ( $model->reports as $report ) : ?>
				<tr>
					<?php if ( $last_test_date != $report['test_date'] ): ?>
                                                <td><?php echo Html::encode( $report['test_date'] ); ?></td>
                                        <?php else: ?>
                                                <td> - </td>
                                        <?php endif; ?>
					<td><?php echo Html::encode( $report['room'] ); ?></td>
					<td><?php echo Html::encode( $report['period'] ); ?></td>
					<td><?php echo Html::encode( $report['num'] ); ?></td>
				</tr>
				<?php $last_test_date = $report['test_date']; ?>
		<?php endforeach; ?>
			</tbody>
		</table>
	<?php else: ?>
		<p>No positive cases reported so far.</p>
	<?php endif; ?>
</div>

