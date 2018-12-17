<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Управление датами';
$this->params['breadcrumbs'][] = ['label' => 'Список записей', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="reception-management">
    
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Запланировать дату', ['time'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Удалить дату', ['remove'], ['class' => 'btn btn-danger']) ?>
    </p>
</div>


