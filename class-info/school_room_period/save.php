<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\School;
use yii\helpers\ArrayHelper;

?>

<h1>Save School Room/Period</h1>

<?php
$form = ActiveForm::begin([
    'id' => 'school-room-period-form',
    'options' => ['class' => 'form-vertical'],
]) ?>
    <?= $form->field($model, 'school_id')->dropDownList( ArrayHelper::map( School::find()->orderBy( 'name' )->all(), 'id', 'name' ) )->label( 'School' ) ?>
    <?= $form->field($model, 'room')->textInput()->label( 'School room' ) ?>
    <?= $form->field($model, 'period')->textInput()->label( 'Class period' ) ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>
