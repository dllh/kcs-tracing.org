<?php
use yii\helpers\Html;
use app\models\BoardMember;
use yii\data\Pagination;
use yii\widgets\LinkPager;

$this->title = 'Board Members';

// Add relevant info to the page title and nav breadcrumbs.
$this->params[ 'breadcrumbs' ][] = $this->title;

?>

<div class="site-board">
	<h1><?= html::encode( $this->title ) ?></h1>

	<?php if ( ! Yii::$app->user->isGuest ): ?>
                <div style="float: right;">
                <?php echo Html::a( 'New Board Member', [ 'board-members/create' ] ); ?>
                </div>
        <?php endif; ?>
	<table>
		<tr>
			<th>Name</th>
			<th>District</th>
			<th>Phone</th>
			<th>Address</th>
		</tr>

		<?php
			$query = BoardMember::find()->orderBy( [ 'district' => SORT_ASC ] );
                        $count = $query->count();
                        $pagination = new Pagination( [ 'pageSize' => 20, 'totalCount' => $count ] );
                        $boardMembers = $query->offset( $pagination->offset )
                                ->limit( $pagination->limit )
                                ->all();
                ?>
		<?php foreach( $boardMembers as $member ) : ?>
			<tr>
				<td><?php echo Html::a( $member->name, [ 'board-members/view', 'id' => $member->id ]); ?></td>
				<td><?php echo Html::encode( $member->district ); ?></td>
				<td><?php echo Html::encode( $member->phone ); ?></td>
				<td><?php echo Html::a( $member->email, 'mailto:' . $member->email ); ?></td>
			</tr>	
		<?php endforeach; ?>
	</table>
	<?php echo LinkPager::widget( [ 'pagination' => $pagination ] ); ?>
</div>

