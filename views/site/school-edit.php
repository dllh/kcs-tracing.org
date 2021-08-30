<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'school-form',
    'options' => ['class' => 'form-vertical'],
]) ?>
    <?= $form->field($model, 'name')->textInput()->label( 'School name' ) ?>
    <?= $form->field($model, 'phone')->textInput()->label( 'School phone' ) ?>
    <?= $form->field($model, 'address')->textInput()->label( 'School Address' ?>
    <?= $form->field($model, 'url')->textInput()->label( 'School URL' ) ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>
