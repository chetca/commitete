<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Reception */

$this->title = 'Запись';
$this->params['breadcrumbs'][] = ['label' => 'Список записей', 'url' => ['index', 'ReceptionSearch[date]' => $model->date]];
$this->params['breadcrumbs'][] = ['label' => Yii::$app->formatter->asTime($model->time->time, 'HH:mm'), 'url' => ['view', 'id' => $model->time_id]];
?>
<div class="reception-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php //echo Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('Назад', ['index', 'ReceptionSearch[date]' => $model->date], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'id',
            ],
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
            [
                'attribute' => 'userPhone',
                'value' => function ($model) {
                    return $model->user->phone;
                },
            ],
            [
                'attribute' => 'userEmail',
                'value' => function ($model) {
                    return $model->user->email;
                },
            ],
            [
                'attribute' => 'record',
                'format' =>  [
                    'time', 'dd.MM.Y HH:mm'
                ],
                'value' => function($model) {
                    Yii::$app->formatter->timeZone = 'Asia/Irkutsk';
                    return $model->record;
                },
            ],
        ],
    ]) ?>

    <p>
        <?= Html::button('<span class="glyphicon glyphicon-print"></span> Печать', [
            'class' => 'btn btn-success',
            'onclick' => 'print()',
        ]) ?>
    </p>

</div>
