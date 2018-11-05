<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Reception */

$this->title = 'Запись';
$this->params['breadcrumbs'][] = ['label' => 'Список записей', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->time->time, 'url' => ['view', 'id' => $model->time_id]];
$this->params['breadcrumbs'][] = 'Запись';
?>
<div class="reception-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <h4>Выбранная дата: <?= Yii::$app->formatter->asDate($model->date, 'php:d.m.Y'); ?></h4>
    <h4>Выбранное время: <?= Yii::$app->formatter->asTime($model->time->time, 'hh:mm'); ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
