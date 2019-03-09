<?php

namespace common\models;

use Yii;
use \common\models\base\TrainVoyage as BaseTrainVoyage;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "train_voyage".
 */
class TrainVoyage extends BaseTrainVoyage
{
	/**
	 * @return array
	 */
    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                # custom behaviors
            ]
        );
    }

	/**
	 * @return array
	 */
    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(),
            [
				[ [ 'time_departure', 'time_arrival' ], 'match', 'pattern' => '/(^([0-9]|[0-1][0-9]|[2][0-3]):([0-5][0-9])$)|(^([0-9]|[1][0-9]|[2][0-3])$)/' ]
            ]
        );
    }

	/**
	 * @return string
	 */
    public function getDays()
	{
		$days = [];

		if( $this->trainSchedule->monday ) $days[] = 'Monday';
		if( $this->trainSchedule->tuesday ) $days[] = 'Tuesday';
		if( $this->trainSchedule->wednesday ) $days[] = 'Wednesday';
		if( $this->trainSchedule->thursday ) $days[] = 'Thursday';
		if( $this->trainSchedule->friday ) $days[] = 'Friday';
		if( $this->trainSchedule->saturday ) $days[] = 'Saturday';
		if( $this->trainSchedule->sunday ) $days[] = 'Sunday';

		if( count($days) === 7 ) return 'Everyday';

		return implode(', ', $days);
	}

	public function dataForApi()
	{
		return [
			'carrier' => [
				'id' 	=> $this->carrier_id,
				'name'	=> $this->carrier->name,
			],
			'station_departure' => [
				'id'	=> $this->station_departure,
				'name'	=> $this->stationDeparture->name
			],
			'station_arrival'	=> [
				'id' 	=> $this->station_arrival,
				'name'	=> $this->stationArrival->name
			],
			'time_departure'	=> $this->time_departure,
			'time_arrival'		=> $this->time_arrival,
			'cost'				=> $this->cost
		];
	}
}
