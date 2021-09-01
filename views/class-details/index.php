<?php
use yii\helpers\Html;
use yii\data\Pagination;
use yii\widgets\LinkPager;
use app\models\ClassDetail;
$this->title = 'Class Details';

// Add relevant info to the page title and nav breadcrumbs.
$this->params[ 'breadcrumbs' ][] = $this->title;

?>

<div class="class-details">
	<h1><?= html::encode( $this->title ) ?></h1>

	<?php if ( ! Yii::$app->user->isGuest ): ?>
                <div style="float: right;">
                <?php echo Html::a( 'New Class Details', [ 'exposures/create' ] ); ?>
                </div>
	<?php endif; ?>

	<table>
		<tr>
			<th>School</th>
			<th>Room</th>
			<th>Period</th>
		</tr>

		<?php
			$query = ClassDetail::find();
			$count = $query->count();
			$pagination = new Pagination( [ 'pageSize' => 20, 'totalCount' => $count ] );
			$classDetail = $query->offset( $pagination->offset )
		      		->limit( $pagination->limit )
				->all();
		?>
		<?php foreach( $classDetail as $detail ) : ?>
			<tr>
				<td><?php echo Html::a( $detail->school->name, [ 'class-details/view', 'id' => $detail->school_id ]); ?></td>
				<td><?php echo Html::encode( $detail->room ); ?></td>
				<td><?php echo Html::encode( $detail->period ); ?></td>
			</tr>	
		<?php endforeach; ?>
	</table>
	<?php echo LinkPager::widget( [ 'pagination' => $pagination ] ); ?>
</div>

