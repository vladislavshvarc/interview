<?php
/**
 * Created by IntelliJ IDEA.
 * User: vladislav
 * Date: 3/9/19
 * Time: 10:14 AM
 */

namespace common\models\forms;

use common\models\TrainSchedule;
use common\models\TrainVoyage;
use yii\base\Model;
use Yii;

class VoyageForm extends Model
{
	/** @var integer */
	public $id;

	/** @var integer */
	public $carrier_id;

	/** @var integer */
	public $station_departure;

	/** @var integer */
	public $station_arrival;

	/** @var string */
	public $time_departure;

	/** @var string */
	public $time_arrival;

	/** @var string */
	public $cost;

	/** TRAIN SCHEDULE **/

	/** @var boolean */
	public $monday;

	/** @var boolean */
	public $tuesday;

	/** @var boolean */
	public $wednesday;

	/** @var boolean */
	public $thursday;

	/** @var boolean */
	public $friday;

	/** @var boolean */
	public $saturday;

	/** @var boolean */
	public $sunday;

	/**
	 * @return array
	 */
	public function rules()
	{
		return [
			[['carrier_id', 'station_departure', 'station_arrival', 'time_departure', 'time_arrival', 'cost'], 'required'],
			[['carrier_id', 'station_departure', 'station_arrival'], 'integer'],
			[['cost'], 'number'],
			[['time_departure', 'time_arrival'], 'string', 'max' => 255],
			[['carrier_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\Carrier::className(), 'targetAttribute' => ['carrier_id' => 'id']],
			[['station_arrival'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\Station::className(), 'targetAttribute' => ['station_arrival' => 'id']],
			[['station_departure'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\Station::className(), 'targetAttribute' => ['station_departure' => 'id']],
			[['time_departure', 'time_arrival'], 'match', 'pattern' => '/(^([0-9]|[0-1][0-9]|[2][0-3]):([0-5][0-9])$)|(^([0-9]|[1][0-9]|[2][0-3])$)/' ],
			[['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'], 'boolean' ],
			[['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'], 'default', 'value' => 0 ],
		];
	}

	public static function prepareModel( TrainVoyage $voyage )
	{
		$model	= new self();

		$model->id = $voyage->id;

		$model->setAttributes($voyage->getAttributes());

		$model->setAttributes($voyage->trainSchedule->getAttributes());

		return $model;
	}

	/**
	 * @param bool $runValidation
	 * @param null $attributeNames
	 * @return bool
	 * @throws \yii\db\Exception
	 */
	public function save( $runValidation = true, $attributeNames = null )
	{
		$this->validate();

		if( !$this->validate() ) return false;

		$voyage 			= new TrainVoyage();
		$voyageSchedule		= new TrainSchedule();

		if( $this->id ) {

			$voyage = TrainVoyage::findOne($this->id);

			if( !$voyage ) return false;

			$voyageSchedule = $voyage->trainSchedule;
		}

		$voyage->setAttributes($this->getAttributes());

		$voyageSchedule->setAttributes($this->getAttributes());

		$transaction = Yii::$app->db->beginTransaction();

		if( !$voyage->save() ) {
			$transaction->rollBack();
			$this->addErrors($voyage->getErrors());
			return false;
		}

		$voyageSchedule->voyage_id = $voyage->id;

		if( !$voyageSchedule->save() ) {
			$transaction->rollBack();
			$this->addErrors($voyageSchedule->getErrors());
			return false;
		}

		$transaction->commit();

		return $voyage->id;
	}


}