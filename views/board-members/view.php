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

	<h3>Daily New Cases in This District</h3>
        <div class="chart" id="total-daily-cases">
                <?php
                        echo GoogleChart::widget(
                                array(
                                        'visualization' => 'ColumnChart',
                                        'data' => $model->dailyCases,
                                        'options' => [
						'title' => 'Daily New Cases Reported by Parents, Last 30 Days',
						'height' => 350,
						'pointsVisible' => true,
						//'hAxis' => [ 
						//	'title' => 'Date',
						//],
						'vAxis' => [ 
							'viewWindow' => ['min' => 0 ],
							'format' => '#',
						],
						'colors' => [ '#62b2af' ],
                                        ]
                                )
                        );
                ?>
	</div>


	<h3>New Cases by Date and Grade</h3>
        <?php if ( count( $model->reports ) > 0 ) : ?>
                <table>
                        <thead>
                                <tr>
                                        <th>School</th>
                                        <th>New Case Date</th>
                                        <th>Grade</th>
                                        <th>Count</th>
                                </tr>
                        </thead>
			<tbody>
		<?php 
			$last_school_name = ''; 
			$last_date = '';
		?>
                <?php foreach ( $model->reports as $report ) : ?>
				<tr>
					<?php if ( $last_school_name != $report['school_name'] ): ?>
						<td><?php echo Html::a( $report['school_name'], [ 'schools/view', 'id' => (int) $report['school_id'] ] ); ?></td>
					<?php else: ?>
						<td> - </td>
					<?php endif; ?>

					<?php if ( $last_date != $report['new_case_date'] ): ?>
                                        	<td><?php echo Html::encode( $report['new_case_date'] ); ?></td>
					<?php else: ?>
						<td> - </td>
					<?php endif; ?>

                                        <td><?php echo Html::encode( $report['grade'] ); ?></td>
                                        <td><?php echo Html::encode( $report['num'] ); ?></td>
				</tr>
				<?php 
					$last_school_name = $report['school_name']; 
					$last_date = $report['new_case_date']; 
				?>
                <?php endforeach; ?>
                        </tbody>
                </table>
        <?php else: ?>
                <p>No positive cases reported so far.</p>
        <?php endif; ?>
</div>

