<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\model   s\Entries */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="entries-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hours')->textInput(['maxlength' => true, 'autocomplete' => 'off', 'type' => 'number', 'step' => '0.25']) ?>

    <?php

    if (Yii::$app->devicedetect->isMobile() || Yii::$app->devicedetect->isTablet()) {
        echo $form->field($model, 'entry_date')->textInput(['type' => 'date', 'autocomplete' => 'off']);
    } else {
        echo $form->field($model, 'entry_date')->widget(
            DatePicker::className(), [
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd'
            ]
        ]);
    }

    ?>

    <p></p>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Save') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
