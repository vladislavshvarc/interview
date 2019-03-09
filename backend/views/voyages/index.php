<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Train Voyages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="train-voyage-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Train Voyage', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
			[
				'attribute' => 'carrier_id',
				'value'     => function( $model ) {
					/** @var \common\models\TrainVoyage $model */
					return $model->carrier->name;
				}
			],
            [
                'attribute' => 'station_departure',
                'value'     => function( $model ) {
                    /** @var \common\models\TrainVoyage $model */
                    return $model->stationDeparture->name;
                }
            ],
			[
				'attribute' => 'station_arrival',
				'value'     => function( $model ) {
					/** @var \common\models\TrainVoyage $model */
					return $model->stationArrival->name;
				}
			],
            'time_departure',
            'time_arrival',
            'cost',
            //'created_at',
            'updated_at:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
