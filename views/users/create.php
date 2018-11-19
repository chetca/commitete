<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = 'Запись на приём';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?php echo Html::a('Назад', ['/reception', 'ReceptionSearch[date]' => $receptionData['date']], ['class' => 'btn btn-primary']) ?>
    </p>
    <h3>Дата: <?= date('d.m.Y', strtotime($receptionData['date'])) ?></h3>
    <h3>Время: <?= $receptionData['time'] ?></h3>
    <h3>Данные посетителя: </h3>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
