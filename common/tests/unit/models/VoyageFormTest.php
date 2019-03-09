<?php

use common\fixtures\CarrierFixture;
use common\fixtures\StationFixture;

/**
 * Created by IntelliJ IDEA.
 * User: vladislav
 * Date: 3/9/19
 * Time: 11:39 AM
 */

class VoyageFormTest extends \Codeception\Test\Unit
{
	/**
	 * @var \common\tests\UnitTester
	 */
	protected $tester;

	/**
	 * @return array
	 */
	public function _fixtures()
	{
		return [
			'carrier' => [
				'class' => CarrierFixture::className(),
				'dataFile' => codecept_data_dir() . 'carrier.php'
			],
			'station' => [
				'class' => StationFixture::className(),
				'dataFile' => codecept_data_dir() . 'station.php'
			]
		];
	}

	public function testCreatingVoyage()
	{
		$model = new \common\models\forms\VoyageForm();

		$model->validate();

		expect('Carrier is required', $model->getFirstError('carrier_id'))->contains('cannot be blank.');
		expect('St depart is required', $model->getFirstError('station_departure'))->contains('cannot be blank.');
		expect('St arrival is required', $model->getFirstError('station_arrival'))->contains('cannot be blank.');
		expect('Time depart is required', $model->getFirstError('time_departure'))->contains('cannot be blank.');
		expect('Time arrival is required', $model->getFirstError('time_arrival'))->contains('cannot be blank.');
		expect('Cost is required', $model->getFirstError('cost'))->contains('cannot be blank.');

		$model->time_arrival = '123';

		expect('Time arrival is in wrong format', $model->validate('time_arrival'))->false();

		$model->time_arrival = '12:35';

		expect('Time arrival is in correct format', $model->validate('time_arrival'))->true();

		$model->carrier_id  = 0;

		$model->station_arrival = 0;

		$model->station_departure = 0;

		$model->validate();

		expect('Carrier not found', $model->getFirstError('carrier_id'))->contains('is invalid.');

		expect('Station arrival not found', $model->getFirstError('carrier_id'))->contains('is invalid.');

		expect('Station departure not found', $model->getFirstError('carrier_id'))->contains('is invalid.');

		$model->carrier_id = 1;

		$model->station_departure = 1;

		$model->station_arrival = 1;

		$model->time_arrival = '15:35';

		$model->time_departure = '20:35';

		$model->cost = 1000;

		$id = $model->save();

		expect('Voyage saved', $id)->notEquals(false);

		$voyage = \common\models\TrainVoyage::findOne($id);

		expect('Voyage exists in database', $voyage)->notNull();

	}
}