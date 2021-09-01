<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<h1>Save Board Member</h1>

<?php
$form = ActiveForm::begin([
    'id' => 'board-member-form',
    'options' => ['class' => 'form-vertical'],
]) ?>
    <?= $form->field($model, 'name')->textInput()->label( 'Name' ) ?>
    <?= $form->field($model, 'phone')->textInput()->label( 'Phone' ) ?>
    <?= $form->field($model, 'email')->textInput()->label( 'Email Address' ) ?>
    <?= $form->field($model, 'district')->textInput()->label( 'District' ) ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>
