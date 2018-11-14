<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = $model->last_name .' '. $model->first_name .' '. $model->middle_name;
$this->params['breadcrumbs'][] = ['label' => 'Посетители', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'first_name',
            'middle_name',
            'last_name',
            'phone',
            'email:email',
        ],
    ]) ?>

    <h3>Запись:</h3>
    <div    >
        <?php
            $dataProvider = new ActiveDataProvider([
                'query' => $reception,
            ]);
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'layout'=>"{pager}\n{items}",
                'columns' => [
                    [
                        'attribute' => 'id',
                        'headerOptions' => ['width' => '80'],
                    ],
                    [
                        'attribute' => 'date',
                        'format' =>  ['date', 'd.M.Y'],
                        'headerOptions' => ['width' => '80'],
                    ],
                    [
                        'attribute' => 'timeReal',
                        'value' => 'time.time',
                        'format' =>  ['time', 'HH:mm'],
                        'headerOptions' => ['width' => '80'],
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
                        'header' => 'ФИО',
                        'value' => function ($model) {
                            if(isset($model->user)) {
                                return $model->user->last_name .' '. $model->user->first_name .' '. $model->user->middle_name;
                            }
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
                        'headerOptions' => ['width' => '150'],
                    ],
                
                    ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Просмотр',
                        'template' => '{view}',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                if($model->status_id == 2) {
                                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 
                                        '/reception/view?id='.$model->id,
                                        [
                                            'title' => Yii::t('yii', 'Просмотр'),
                                        ]
                                    );
                                }
                            },
                        ],
                    ]
                ],
            ]);
        ?>
    </div>
    

</div>
