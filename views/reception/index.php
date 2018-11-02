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
        'tableOptions' => [
            'class' => 'table table-striped table-bordered'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            //'date:date',
            [
                'attribute' => 'date',
                'format' =>  ['date', 'dd.MM.Y'],
                //'locale' => 'ru-RU',
            ],
            [
                'attribute' => 'time_id',
                'value' => 'time.time',
                'format' =>  ['time', 'HH:mm'],
            ],
            /*
            [
                'attribute' => 'status_id',
                'value' => 'status.status',
            ],
            */
            [
                'attribute'=>'status_id',
                'format'=>'text', 
                'content'=>function($data) {
                    return $data->getStatusName();
                },
                //'filter' => Status::getStatusList(),
                'filter' => array("1"=>"Время свободно","2"=>"Время занято"),
            ],
            /*
            [
                'attribute' => 'operator_id',
                'value' => 'operator.operator',
            ],
            */
            [
                'attribute'=>'operator_id',
                'format'=>'text', 
                'content'=>function($data) {
                    return $data->getOperatorName();
                },
                'filter' => array("1"=>"Оператор 1","2"=>"Оператор 2"),
            ],
            [
                'attribute' => 'user_id',
                'value' => 'user.last_name',
            ],

            ['class' => 'yii\grid\ActionColumn',
                'header'=>'Действия', 
                'headerOptions' => ['width' => '80'],
                'template' => '{view} {update} {delete}{link}',
            ],
        ],
    ]); ?>
</div>
