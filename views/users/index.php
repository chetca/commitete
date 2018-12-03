<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Посетители';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            'first_name',
            'middle_name',
            'last_name',
            [
                'attribute' => 'phone',
                'filter' => MaskedInput::widget([
                    'model' => $searchModel,
                    'attribute' => 'phone',
                    'mask' => '+7 (999) 999 99 99',
                ]),
            ],
            'email:email',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}  {update}',
            ]
        ],
    ]); ?>
</div>
