<?php
use yii\helpers\Html;
use app\models\Report;
use yii\widgets\ActiveForm;

$this->title = 'Report';

// Add relevant info to the page title and nav breadcrumbs.
$this->params[ 'breadcrumbs' ][] = 'Reports';

$formatter = \Yii::$app->formatter;

?>


<?php if ( isset( $_GET['saved'] ) ) : ?>
<div id="saved">
    <h1>Thank you!</h1>
    <p>Thank you for submitting information re: your KCS student's positive COVID test. The data you provided will help us communicate to other KCS parents and the community-at-large about the impact of the disease in our schools. It is our sincere hope that your child recovers quickly and completely.</p>

    <p>Please remember to share information about your child's illness with your school's DIY Contact Tracing group on Facebook.</p>

    <p>If you need to find out how to connect to your school's group, please follow <a href="https://docs.google.com/spreadsheets/d/1oS1f7F2Xz_mMGINZEP0Nwf_emi6NTcnIXg-ATXs-q1w/edit#gid=935460680">this link</a>.

    <p>If your school does not have a group and you are willing to be an admin, please connect with the <a href="https://www.facebook.com/groups/SPEAKTN">SPEAK: Students Parents Educators Across Knox County</a> group on Facebook and that community will help you get started.</p>
</div>
<?php endif; ?>

<div class="site-exposure">
	<h1>Report</h1>
	<table>
		<tr>
			<th>School</th>
			<td><?php echo Html::a( $model->school->name, [ 'schools/view', 'id' => $model->school_id ]); ?></td>
		</tr>
		<tr>
			<th>Grade Level</th>
			<td><?php echo Html::encode( $model->grade ) ?></td>
		</tr>
		<tr>
			<th>Symptomatic Date</th>
			<td><?php echo Html::encode( $formatter->asDate( $model->symptomatic_date ), 'date' ) ?></td>
		</tr>
		<tr>
			<th>Positive Test Date</th>
			<td><?php echo Html::encode( $formatter->asDate( $model->positive_test_date ), 'date' ) ?></td>
		</tr>
	</table>
</div>

