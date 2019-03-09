<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\forms\VoyageForm */

$this->title = 'Create Train Voyage';
$this->params['breadcrumbs'][] = ['label' => 'Train Voyages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="train-voyage-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model'     => $model
    ]) ?>

</div>
