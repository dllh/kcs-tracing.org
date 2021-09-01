<?php
use yii\helpers\Html;
use app\models\School;
use yii\data\Pagination;
use yii\widgets\LinkPager;

$this->title = 'Schools';

// Add relevant info to the page title and nav breadcrumbs.
$this->params[ 'breadcrumbs' ][] = $this->title;

?>

<div class="site-schools">
	<h1><?= html::encode( $this->title ) ?></h1>

	<?php if ( ! Yii::$app->user->isGuest ): ?>
                <div style="float: right;">
                <?php echo Html::a( 'New School', [ 'schools/create' ] ); ?>
                </div>
        <?php endif; ?>
	<table>
		<tr>
			<th>Name</th>
			<th>Phone</th>
			<th>Address</th>
		</tr>

		<?php
			$query = School::find()->orderBy( [ 'name' => SORT_ASC ] );
                        $count = $query->count();
                        $pagination = new Pagination( [ 'pageSize' => 20, 'totalCount' => $count ] );
                        $schools = $query->offset( $pagination->offset )
                                ->limit( $pagination->limit )
                                ->all();
                ?>
		<?php foreach( $schools as $school ) : ?>
			<tr>
				<td><?php echo Html::a( $school->name, [ 'schools/view', 'id' => $school->id ]); ?></td>
				<td><?php echo Html::encode( $school->phone ); ?></td>
				<td><?php echo Html::encode( $school->address ); ?></td>
			</tr>	
		<?php endforeach; ?>
	</table>
	<?php echo LinkPager::widget( [ 'pagination' => $pagination ] ); ?>
</div>

