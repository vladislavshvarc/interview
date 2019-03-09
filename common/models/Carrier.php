<?php

namespace common\models;

use Yii;
use \common\models\base\Carrier as BaseCarrier;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "carriers".
 */
class Carrier extends BaseCarrier
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
