<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<h1>Save Exposure</h1>

<?php
$form = ActiveForm::begin([
    'id' => 'exposure-form',
    'options' => ['class' => 'form-vertical'],
]) ?>
    <?= $form->field($model, 'school_id')->textInput()->label( 'School id' ) ?>
    <?= $form->field($model, 'room')->textInput()->label( 'School room' ) ?>
    <?= $form->field($model, 'period')->textInput()->label( 'Class period' ) ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>
