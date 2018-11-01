<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReceptionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список записей';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reception-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить запись', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            'date:date',
            [
                'attribute' => 'time_id',
                'value' => 'time.time',
            ],
            [
                'attribute' => 'status_id',
                'value' => 'status.status',
            ],
            [
                'attribute' => 'operator_id',
                'value' => 'operator.operator',
            ],
            [
                'attribute' => 'user_last_name',
                'value' => 'user.last_name',
            ],
            [
                'attribute' => 'user_first_name',
                'value' => 'user.first_name',
            ],
            [
                'attribute' => 'user_middle_name',
                'value' => 'user.middle_name',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
