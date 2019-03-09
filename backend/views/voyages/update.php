<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\forms\VoyageForm */

$this->title = 'Update Train Voyage: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Train Voyages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="train-voyage-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model'     => $model
    ]) ?>

</div>
