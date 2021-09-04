<?php
use yii\helpers\Html;
use app\models\BoardMember;
use yii\widgets\ActiveForm;
use scotthuangzl\googlechart\GoogleChart;

$this->title = 'Board Member - ' . $model->name;

// Add relevant info to the page title and nav breadcrumbs.
$this->params[ 'breadcrumbs' ][] = 'Board Members';
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
			<th>Email</th>
			<td><?php echo Html::a( $model->email, 'mailto:' . $model->email ) ?></td>
		</tr>
		<tr>
			<th>District</th>
			<td><?php echo Html::encode( $model->district ) ?></td>
		</tr>
		<tr>
			<th>Schools Served</th>
			<td>
				<ul>
			<?php foreach ( $model->schools as $school ) : ?>
				<li><?php echo Html::a( $school->name, [ 'schools/view', 'id' => $school->id ] ) ?></li>
			<?php endforeach; ?>
				</ul>
			</td>
		</tr>
	</table>

	<h3>Daily Positive Test Cases in This District</h3>
        <div class="chart" id="total-daily-cases">
                <?php
                        echo GoogleChart::widget(
                                array(
                                        'visualization' => 'LineChart',
                                        'data' => $model->dailyCases,
                                        'options' => [
						'title' => 'Daily Positive Test Cases Reported by Parents, Last 30 Days',
						'height' => 350,
						'hAxis' => [ 
							'title' => 'Date',
						],
						'vAxis' => [ 
							'viewWindow' => ['min' => 0 ],
							'format' => '#',
						],
                                        ]
                                )
                        );
                ?>
	</div>


	<h3>Positive Test Reports by Date, Period, and Room</h3>
        <b>Instructions</b><br />
        <p>Find your child's school in the first column. Then find the date you're concerned about in the second column. Then move to the third column and the fourth column to find your child's room and class period. If you see positive case counts for the date in question, it's possible your child has been exposed to COVID. We're showing only the last 30 days worth of data.</p>
        <p><b>Note:</b>This data is voluntarily reported by parents and is only as accurate as the data they submit. You should use it as a very rough guide but should not treat it as rock-solid, irrefutable data or proof of exposure.</p>
        <?php if ( count( $model->reports ) > 0 ) : ?>
                <table>
                        <thead>
                                <tr>
                                        <th>School</th>
                                        <th>Date</th>
                                        <th>Room</th>
                                        <th>Period</th>
                                        <th>Count</th>
                                </tr>
                        </thead>
			<tbody>
		<?php 
			$last_school_name = ''; 
			$last_test_date = '';
		?>
                <?php foreach ( $model->reports as $report ) : ?>
				<tr>
					<?php if ( $last_school_name != $report['school_name'] ): ?>
						<td><?php echo Html::encode( $report['school_name'] ); ?></td>
					<?php else: ?>
						<td> - </td>
					<?php endif; ?>

					<?php if ( $last_test_date != $report['test_date'] ): ?>
                                        	<td><?php echo Html::encode( $report['test_date'] ); ?></td>
					<?php else: ?>
						<td> - </td>
					<?php endif; ?>

                                        <td><?php echo Html::encode( $report['room'] ); ?></td>
                                        <td><?php echo Html::encode( $report['period'] ); ?></td>
                                        <td><?php echo Html::encode( $report['num'] ); ?></td>
				</tr>
				<?php 
					$last_school_name = $report['school_name']; 
					$last_test_date = $report['test_date']; 
				?>
                <?php endforeach; ?>
                        </tbody>
                </table>
        <?php else: ?>
                <p>No positive cases reported so far.</p>
        <?php endif; ?>
</div>

