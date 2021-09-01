<?php
use yii\helpers\Html;
use yii\data\Pagination;
use yii\widgets\LinkPager;
use app\models\SchoolRoomPeriod;
$this->title = 'School Room/Period';

// Add relevant info to the page title and nav breadcrumbs.
$this->params[ 'breadcrumbs' ][] = $this->title;

?>

<div class="school-room-period">
	<h1><?= html::encode( $this->title ) ?></h1>

	<?php if ( ! Yii::$app->user->isGuest ): ?>
                <div style="float: right;">
                <?php echo Html::a( 'New School Room/Period', [ 'exposures/create' ] ); ?>
                </div>
	<?php endif; ?>

	<table>
		<tr>
			<th>School</th>
			<th>Room</th>
			<th>Period</th>
		</tr>

		<?php
			$query = SchoolRoomPeriod::find();
			$count = $query->count();
			$pagination = new Pagination( [ 'pageSize' => 20, 'totalCount' => $count ] );
			$schoolRoomPeriods = $query->offset( $pagination->offset )
		      		->limit( $pagination->limit )
				->all();
		?>
		<?php foreach( $schoolRoomPeriods as $srp ) : ?>
			<tr>
				<td><?php echo Html::a( $srp->school->name, [ 'school_room_period/view', 'id' => $srp->school_id ]); ?></td>
				<td><?php echo Html::encode( $srp->room ); ?></td>
				<td><?php echo Html::encode( $srp->period ); ?></td>
			</tr>	
		<?php endforeach; ?>
	</table>
	<?php echo LinkPager::widget( [ 'pagination' => $pagination ] ); ?>
</div>

