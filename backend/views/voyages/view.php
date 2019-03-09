<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TrainVoyage */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Train Voyages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="train-voyage-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
            [
                'label' => 'Days',
                'value' => function( $model ) {
                    /** @var $model \common\models\TrainVoyage */
                    return $model->getDays();
                }
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
