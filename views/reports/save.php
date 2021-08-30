<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<h1>Save Report</h1>

<?php
$form = ActiveForm::begin([
    'id' => 'report-form',
    'options' => ['class' => 'form-vertical'],
]) ?>
    <?= $form->field($model, 'school_id')->textInput()->label( 'School id' ) ?>
    <?= $form->field($model, 'exposure_id')->textInput()->label( 'Exposure id' ) ?>
    <?= $form->field($model, 'positive_test_date')->textInput()->label( 'Pos. Test Date' ) ?>
    <?= $form->field($model, 'zipcode')->textInput()->label( 'Zip Code' ) ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>
