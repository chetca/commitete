<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Reception */

$this->title = 'Запись';
$this->params['breadcrumbs'][] = ['label' => 'Список записей', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::$app->formatter->asTime($model->time->time, 'hh:mm'), 'url' => ['view', 'id' => $model->time_id]];
?>
<div class="reception-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'date',
                'format' =>  ['date', 'dd.MM.Y'],
            ],
            [
                'attribute' => 'time_id',
                'format' =>  ['time', 'HH:mm'],
                'value' => function ($model) {
                    return $model->time->time;
                },
            ],
            [
                'attribute' => 'user_id',
                'value' => function ($model) {
                    return $model->user->last_name .' '. $model->user->first_name .' '. $model->user->middle_name;
                },
            ],
        ],
    ]) ?>

</div>
