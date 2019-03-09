<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;;
use common\models\Carrier;
use common\models\Station;
use kartik\time\TimePicker;

/* @var $this yii\web\View */
/* @var $model common\models\forms\VoyageForm */
/* @var $form yii\widgets\ActiveForm */

$this->registerJs(
    '
        jQuery("#trainschedule-everyday").on(\'change\', function() {
            if( jQuery(this).is(\':checked\') ) {
                jQuery(\'.train__schedule input[type="checkbox"]\').prop(\'checked\', true);
            } else {
                jQuery(\'.train__schedule input[type="checkbox"]\').prop(\'checked\', false);
            }
        });
    '
);

?>

<div class="train-voyage-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'carrier_id')->dropDownList(
            ArrayHelper::map(Carrier::find()->all(), 'id', 'name')
    ) ?>

    <?= $form->field($model, 'station_departure')->dropDownList(
            ArrayHelper::map(Station::find()->all(), 'id', 'name')
    ) ?>

    <?= $form->field($model, 'station_arrival')->dropDownList(
		    ArrayHelper::map(Station::find()->all(), 'id', 'name')
	) ?>

    <?= $form->field($model, 'time_departure')->widget(TimePicker::classname(), [
            'pluginOptions' => [
                'showMeridian'  => false
            ]
    ]); ?>

    <?= $form->field($model, 'time_arrival')->widget(TimePicker::classname(), [
            'pluginOptions' => [
                'showMeridian'  => false
            ]
    ]); ?>

    <?= $form->field($model, 'cost')->textInput() ?>

    <hr>

    <div class="train__schedule">
        <div class="form-group">
            <label>
                <input type="checkbox" id="trainschedule-everyday" value="1">
                Everyday
            </label>
        </div>

        <?= $form->field($model, 'monday')->checkbox() ?>

        <?= $form->field($model, 'tuesday')->checkbox() ?>

        <?= $form->field($model, 'wednesday')->checkbox() ?>

        <?= $form->field($model, 'thursday')->checkbox() ?>

        <?= $form->field($model, 'friday')->checkbox() ?>

        <?= $form->field($model, 'saturday')->checkbox() ?>

		<?= $form->field($model, 'sunday')->checkbox() ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
