<?php
use yii\helpers\Html;
use app\models\BoardMember;
use yii\widgets\ActiveForm;

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
        <h2>Positive Case Reports in District</h2>
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

