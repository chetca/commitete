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
        <?= Html::a('Запланировать дни', ['time'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-striped table-bordered'
        ],
        'rowOptions' => function ($model) {
            if ($model->status_id == '1') {
                return ['class' => 'success'];
            } else {
                return ['class' => 'danger'];
            }
        },
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
                'filter' => array("1"=>"Оператор 1","2"=>"Оператор 2", "3"=>"Оператор 3"),
            ],
            [
                'attribute' => 'user_id',
                'value' => function ($model) {
                    if(isset($model->user)) {
                        return $model->user->last_name .' '. $model->user->first_name .' '. $model->user->middle_name;
                    }
                },
            ],

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{link}  {delete}',
                'buttons' => [
                    'link' => function ($url,$model) {
                        if($model->status_id == 1) {
                            return Html::a(
                                '<span class="glyphicon glyphicon-pencil"></span>',
                                '/users/create?id='.$model->id,
                                [
                                    'title' => Yii::t('yii', 'Создать запись'),
                                ]
                            );
                        }
                    },
                    'delete' => function ($url, $model) {
                        if($model->status_id == 2) {
                            return Html::a('<span class="glyphicon glyphicon-remove"></span>', $url,[
                                'title' => Yii::t('yii', 'Удалить'),
                                'data-confirm' => 'Вы уверены что ходите удалить запись?',
                                'data-method' => 'post',
                                'data-pjax' => '0',
                            ]);
                        }
                    },
                ],
            ],
        ],
    ]); ?>
</div>
