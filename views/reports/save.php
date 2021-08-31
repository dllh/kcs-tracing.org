<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use app\models\School;
use yii\helpers\ArrayHelper;

?>

<h1>Save Report</h1>

<?php
$form = ActiveForm::begin([
    'id' => 'report-form',
    'options' => ['class' => 'form-vertical'],
]) ?>
    <?= $form->field($model, 'school_id')->dropDownList( ArrayHelper::map( School::find()->orderBy( 'name' )->all(), 'id', 'name' ) )->label( 'School' ) ?>
    <?= $form->field($model, 'exposure_id')->textInput()->label( 'Exposure id' ) ?>
    <?= $form->field($model, 'positive_test_date')->widget(\yii\jui\DatePicker::classname(), [ 'dateFormat' => 'yyyy-MM-dd', ] ) ?>
    <?= $form->field($model, 'zipcode')->textInput()->label( 'Zip Code' ) ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>
