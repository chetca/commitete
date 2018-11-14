<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\ReceptionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reception-search form-group">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php //echo $form->field($model, 'id') ?>

    <?php //echo $form->field($model, 'timeReal') ?>

    <?php //echo $form->field($model, 'date')->input('date'); ?>

    <div class="calendar-form">
        <?= DatePicker::widget([
            'options' => ['placeholder' => 'Выберете необходимую дату'],
            'name' => 'ReceptionSearch[date]',
            'value' => Yii::$app->request->get('ReceptionSearch')['date'],
            'pluginOptions' => [
                'format' => 'yyyy-m-d',
                'startDate' => '2018-11-01',
                'todayHighlight' => true,
                'autoclose'=>true,
                'daysOfWeekDisabled' => [0, 1, 3, 5, 6],
            ]
        ]); ?>
    </div>

    <?php //echo $form->field($model, 'status_id') ?>

    <?php //echo $form->field($model, 'operator_id') ?>

    <?php //echo $form->field($model, 'userNameReal') ?>

    <div class="form-group">
        <?= Html::submitButton('Открыть', ['class' => 'btn btn-primary']) ?>
        <a href="<?=Url::to(['index?ReceptionSearch[date]='])?>" class="btn btn-default">Все записи</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
