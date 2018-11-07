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

    

</div>
