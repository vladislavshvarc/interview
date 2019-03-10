<?php

namespace backend\controllers;

use common\controllers\BaseController;
use common\models\forms\VoyageForm;
use yii\web\NotFoundHttpException;
use common\models\TrainSchedule;
use yii\data\ActiveDataProvider;
use common\models\TrainVoyage;
use yii\filters\VerbFilter;
use Yii;

/**
 * VoyagesController implements the CRUD actions for TrainVoyage model.
 */
class VoyagesController extends BaseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

	/**
	 * @return array
	 */
	public function allowedAttributes()
	{
		$voyageAllowedAttributes = [
			'VoyageForm'	=> [
				'carrier_id', 'station_departure', 'station_arrival',
				'time_departure', 'time_arrival', 'cost',
				'monday', 'tuesday', 'wednesday',
				'thursday', 'friday', 'saturday',
				'sunday'
			],
		];

		return [
			'create' 	=> $voyageAllowedAttributes,
			'update' 	=> $voyageAllowedAttributes,
		];
	}

	/**
     * Lists all TrainVoyage models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => TrainVoyage::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TrainVoyage model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

	/**
	 * Creates a new TrainVoyage model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *
	 * @return string|\yii\web\Response
	 * @throws \yii\db\Exception
	 */
    public function actionCreate()
    {
		$model			= new VoyageForm();

        $post 			= $this->getAllowedPost();

        if ($model->load($post) && $id = $model->save()) {
            return $this->redirect(['view', 'id' => $id]);
        }

        return $this->render('create', [
            'model' 	=> $model
        ]);
    }

	/**
	 * Updates an existing TrainVoyage model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param $id
	 * @return string|\yii\web\Response
	 * @throws NotFoundHttpException
	 * @throws \yii\db\Exception
	 */
    public function actionUpdate($id)
    {
		$voyage = $this->findModel($id);

		$model 	= VoyageForm::prepareModel($voyage);

		$post 			= $this->getAllowedPost();

		if ( $model->load($post) && $id = $model->save()) {

			return $this->redirect(['view', 'id' => $id]);
		}

        return $this->render('update', [
            'model' 	=> $model
        ]);
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
