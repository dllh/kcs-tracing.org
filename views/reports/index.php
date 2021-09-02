<?php

use Yii;
use yii\helpers\Html;
use yii\data\Pagination;
use yii\widgets\LinkPager;
use app\models\Report;
$this->title = 'Reports';

// Add relevant info to the page title and nav breadcrumbs.
$this->params[ 'breadcrumbs' ][] = $this->title;

?>

<div class="site-exposures">
	<h1><?= html::encode( $this->title ) ?></h1>

	<?php if ( ! Yii::$app->user->isGuest ): ?>
		<div style="float: right;">
		<?php echo Html::a( 'New Report', [ 'reports/create' ] ); ?>
		</div>
	<?php endif; ?>

	<table>
		<tr>
			<th>School</th>
			<th>Classroom</th>
			<th>Period</th>
			<th>Pos. Test Date</th>
			<th>Zip Code</th>
		</tr>

		<?php
			$query = Report::find();
			$count = $query->count();
			$pagination = new Pagination( [ 'pageSize' => 20, 'totalCount' => $count ] );
			$reports = $query->offset( $pagination->offset )
		      		->limit( $pagination->limit )
				->all();
		?>
		<?php foreach( $reports as $report ) : ?>
			<tr>
				<td><?php echo Html::a( $report->school->name, [ 'schools/view', 'id' => $report->school_id ]); ?></td>
				<td><?php echo Html::encode( $report->room ); ?></td>
				<td><?php echo Html::encode( $report->period ); ?></td>
				<td><?php echo Html::encode( $report->positive_test_date ); ?></td>
				<td><?php echo Html::encode( $report->zipcode ); ?></td>
			</tr>	
		<?php endforeach; ?>
	</table>
	<?php echo LinkPager::widget( [ 'pagination' => $pagination ] ); ?>
</div>

