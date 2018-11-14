<?php

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReceptionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список записей';
$this->params['breadcrumbs'][] = $this->title;

$gridColumns = [
    //['class' => 'yii\grid\SerialColumn'],
    
    [
        'attribute' => 'id',
        'headerOptions' => ['width' => '80'],
    ],
    [
        'attribute' => 'date',
        'format' =>  ['date', 'd.M.Y'],
        'headerOptions' => ['width' => '80'],
        /*
        //Доделать фильтрацию по датам
        //https://github.com/2amigos/yii2-date-picker-widget
        //https://klisl.com/DateTimePicker.html
        'filter' => DatePicker::widget([
            'model' => $searchModel,
            'attribute' => 'created_at',
            'language' => 'ru',
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'dd.mm.yyyy',
            ],
        ]),
        */
    ],
    [
        'attribute' => 'timeReal',
        'value' => 'time.time',
        'format' =>  ['time', 'HH:mm'],
        'headerOptions' => ['width' => '80'],
    ],
    [
        'attribute'=>'status_id',
        'format'=>'text', 
        'content'=>function($data) {
            return $data->getStatusName();
        },
        'filter' => array("1"=>"Время свободно","2"=>"Время занято"),
        'headerOptions' => ['width' => '150'],
    ],
    [
        'attribute'=>'operator_id',
        'format'=>'text', 
        'content'=>function($data) {
            return $data->getOperatorName();
        },
        'filter' => array("1"=>"Оператор 1","2"=>"Оператор 2", "3"=>"Оператор 3"),
        'headerOptions' => ['width' => '120'],
    ],
    [
        'attribute' => 'userNameReal',
        'value' => function ($model) {
            if(isset($model->user)) {
                return $model->user->last_name;
            }
        },
    ],
    /*
    [
        'attribute' => 'userPhone',
        'value' => function ($model) {
            if(isset($model->user)) {
                return $model->user->phone;
            }
        },
        'headerOptions' => ['width' => '150'],
    ],
    */
    [
        'attribute' => 'record',
        'format' =>  [
            'time', 'dd.MM.Y HH:mm'
        ],
        'value' => function($model) {
            Yii::$app->formatter->timeZone = 'Asia/Irkutsk';
            return $model->record;
        },
        'headerOptions' => ['width' => '150'],
    ],

    ['class' => 'yii\grid\ActionColumn',
        'template' => '{view}  {link}  {delete}',
        'buttons' => [
            'view' => function ($url, $model) {
                if($model->status_id == 2) {
                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url,[
                        'title' => Yii::t('yii', 'Просмотр'),
                    ]);
                }
            },
            'link' => function ($url,$model) {
                if($model->status_id == 1) {
                    return Html::a(
                        '<span class="glyphicon glyphicon-pencil"></span>',
                        '/users/create?id='.$model->id.'&ReceptionSearch[date]='.Yii::$app->request->get('ReceptionSearch')['date'],
                        [
                            'title' => Yii::t('yii', 'Создать запись'),
                        ]
                    );
                }
            },
            'delete' => function ($url, $model) {
                if($model->status_id == 2) {
                    return Html::a('<span class="glyphicon glyphicon-remove"></span>',
                        '/reception/delete?id='.$model->id.'&ReceptionSearch[date]='.Yii::$app->request->get('ReceptionSearch')['date'],
                        [
                            'title' => Yii::t('yii', 'Удалить'),
                            'data-confirm' => 'Вы уверены что хотите удалить запись?',
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ]);
                }
            },
        ],
    ]
];?>

<div class="reception-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить записи', ['time'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Удалить записи', ['remove'], ['class' => 'btn btn-danger']) ?>
    </p>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'dropdownOptions' => [
            'label' => 'Выгрузка в файл',
            'class' => 'btn btn-secondary'
        ]
    ]); ?>

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
        'columns' => $gridColumns,
    ]); ?>
</div>
