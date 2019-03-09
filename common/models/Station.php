<?php

namespace common\models;

use Yii;
use \common\models\base\Station as BaseStation;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "stations".
 */
class Station extends BaseStation
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
