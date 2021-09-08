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

	<h3>Daily New Cases at This School</h3>
	<div class="chart" id="total-daily-cases">
	<?php
		// Look for a count > 1 here because the first array item is a header row.
                if ( count( $model->dailyCases ) > 1 ) {
                        echo GoogleChart::widget(
                                array(
                                        'visualization' => 'ColumnChart',
                                        'data' => $model->dailyCases,
                                        'options' => [
                                                'title' => 'Daily New Cases Reported by Parents, Last 30 Days',
						'height' => 350,
						'pointsVisible' => true,
                                                'vAxis' => [
                                                        'viewWindow' => ['min' => 0 ],
                                                        'format' => '#',
						],
						'colors' => [ '#62b2af' ],
                                        ]
                                )
			);
		} else {
			echo '<p>This area should contain a chart that shows new cases reported in the last 30 days. If you\'re seeing this message rather than a chart, it means that we do not have any data for the last 30 days. Please check back again later or <a href="mailto:KCSDashboard@gmail.com">let us know</a> if you think there has been a mistake.</p>';
		}
                ?>
	</div>

	<h3>New Cases by Date and Grade</h3>
	<?php if ( count( $model->reports ) > 0 ) : ?>
		<table>
			<thead>
				<tr>
					<th>Date</th>
					<th>Grade</th>
					<th>Count</th>
				</tr>
			</thead>
			<tbody>
		<?php $last_date = ''; ?>
		<?php foreach ( $model->reports as $report ) : ?>
				<tr>
					<?php if ( $last_date != $report['active_date'] ): ?> 
                                                <td><?php echo Html::encode( $report['active_date'] ); ?></td>
                                        <?php else: ?>
                                                <td> - </td>
                                        <?php endif; ?>
					<td><?php echo Html::encode( $report['grade'] ); ?></td>
					<td><?php echo Html::encode( $report['num'] ); ?></td>
				</tr>
				<?php $last_date = $report['active_date']; ?>
		<?php endforeach; ?>
			</tbody>
		</table>
	<?php else: ?>
		<p>This area should contain a chart that shows new cases reported in the last 30 days. If you're seeing this message rather than a chart, it means that we do not have any data for the last 30 days. Please check back again later or <a href="mailto:KCSDashboard@gmail.com">let us know</a> if you think there has been a mistake.</p>
	<?php endif; ?>
</div>

