<?php

namespace api\controllers;

use common\controllers\BaseApiController;
use common\controllers\BaseController;
use common\models\forms\VoyageForm;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use common\models\TrainSchedule;
use common\models\TrainVoyage;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;
use Yii;

/**
 * ApiVoyagesController implements the CRUD actions for TrainVoyage model.
 */
class VoyagesController extends BaseApiController
{
	/**
	 * @param        $data
	 * @param int    $code
	 * @param string $message
	 * @return array
	 */
	public function returnData($data, $code = 200, $message = '')
	{
		return [
			'code'		=> $code,
			'data'		=> $data,
			'message'	=> $message
		];
	}

	/**
	 * @return array
	 */
	public function allowedAttributes()
	{
		$voyageAllowedAttributes = [
			'carrier_id', 'station_departure', 'station_arrival',
			'time_departure', 'time_arrival', 'cost',
			'monday', 'tuesday', 'wednesday',
			'thursday', 'friday', 'saturday',
			'sunday'
		];

		return [
			'create' 	=> $voyageAllowedAttributes,
			'update' 	=> $voyageAllowedAttributes,
		];
	}

	/**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => [ 'DELETE' ],
					'create' => [ 'POST' ],
					'update' => [ 'PUT' ]
                ],
            ],
        ];
    }

    public function actionError( $exception = null )
	{
		if( empty($exception) )
			$exception = Yii::$app->errorHandler->exception;

		return $this->returnData([], $exception->statusCode, $exception->getMessage());
	}

    /**
     * Lists all TrainVoyage models.
     * @return mixed
     */
    public function actionIndex()
    {
    	$data	 = [];

		$voyages = TrainVoyage::find()->all();

		foreach ( $voyages as $voyage ) $data[] = $voyage->dataForApi();

		return $this->returnData($data);
    }

    /**
     * Creates a new TrainVoyage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		$model 			= new VoyageForm();

		try {
			$data 	= $this->getAllowedBody();
		} catch (\Exception $e) {
			return $this->actionError($e);
		}

		if( empty($data) ) return $this->returnData([], 400, 'Request data is empty');

		$model->setAttributes($data);

		if( !($id = $model->save()) ) {
			return $this->returnData($model->getErrors(), 400, 'Something wrong');
		}

		return $this->returnData([
			'id' => $id
		], 200, 'Voyage successfully created');
    }

    /**
     * Updates an existing TrainVoyage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
		try {
			$voyage = $this->findModel($id);

			$model 	= VoyageForm::prepareModel($voyage);

		} catch ( \Exception $e ) {

			return $this->actionError($e);
		}

		try {
			$data 	= $this->getAllowedBody();
		} catch (\Exception $e) {
			return $this->actionError($e);
		}

		if( empty($data) ) return $this->returnData([], 400, 'Request data is empty');

		$model->setAttributes($data);

		if( !$model->save() ) {
			return $this->returnData($model->getErrors(), 400, 'Something wrong');
		}

		return $this->returnData([], 200, 'Voyage successfully updated');
    }

    /**
     * Deletes an existing TrainVoyage model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
    	try {
			if ($this->findModel($id)->delete()) {
				return $this->returnData([], 200, 'Voyage successfully deleted');
			}
		} catch ( \Exception $e ) {

    		return $this->actionError($e);
		}

		return $this->returnData([], 400, 'Something gone wrong');
    }

    /**
     * Finds the TrainVoyage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TrainVoyage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TrainVoyage::findOne($id)) !== null) {
            return $model;
        }

		throw new NotFoundHttpException('The voyage does not exist.');
    }
}
