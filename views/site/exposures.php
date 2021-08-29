<?php
use yii\helpers\Html;
use yii\data\Pagination;
use yii\widgets\LinkPager;
use app\models\Exposure;
$this->title = 'Exposures';

// Add relevant info to the page title and nav breadcrumbs.
$this->params[ 'breadcrumbs' ][] = $this->title;

?>

<div class="site-exposures">
	<h1><?= html::encode( $this->title ) ?></h1>

	<table>
		<tr>
			<th>School</th>
			<th>Room</th>
			<th>Period</th>
		</tr>

		<?php
			$query = Exposure::find();
			$count = $query->count();
			$pagination = new Pagination( [ 'pageSize' => 20, 'totalCount' => $count ] );
			$exposures = $query->offset( $pagination->offset )
		      		->limit( $pagination->limit )
	      			->all();
		?>
		<?php foreach( $exposures as $exposure ) : ?>
			<tr>
				<td><?php echo Html::a( $exposure->school_id, [ 'site/school', 'id' => $exposure->school_id ]); ?></td>
				<td><?php echo Html::encode( $exposure->room ); ?></td>
				<td><?php echo Html::encode( $exposure->period ); ?></td>
			</tr>	
		<?php endforeach; ?>
	</table>
	<?php echo LinkPager::widget( [ 'pagination' => $pagination ] ); ?>
</div>

