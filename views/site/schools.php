<?php
use yii\helpers\Html;
use app\models\School;
$this->title = 'Schools';

// Add relevant info to the page title and nav breadcrumbs.
$this->params[ 'breadcrumbs' ][] = $this->title;

?>

<div class="site-schools">
	<h1><?= html::encode( $this->title ) ?></h1>

	<table>
		<tr>
			<th>Name</th>
			<th>Phone</th>
			<th>Address</th>
		</tr>

		<?php foreach( School::find()->orderBy( 'name ASC' )->each( 10 ) as $school ) : ?>
			<tr>
				<td><?php echo Html::a( $school->name, [ 'site/school', 'id' => $school->id ]); ?></td>
				<td><?php echo Html::encode( $school->phone ); ?></td>
				<td><?php echo Html::encode( $school->address ); ?></td>
			</tr>	
		<?php endforeach; ?>
	</table>
</div>

