<?php

namespace common\models;

use Yii;
use \common\models\base\TrainSchedule as BaseTrainSchedule;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "train_schedule".
 */
class TrainSchedule extends BaseTrainSchedule
{

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                # custom behaviors
            ]
        );
    }

    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(),
            [
                # custom validation rules
            ]
        );
    }
}
