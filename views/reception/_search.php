<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ReceptionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reception-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php //echo $form->field($model, 'id') ?>

    <?php //echo $form->field($model, 'timeReal') ?>

    <?php echo $form->field($model, 'date')->input('date'); ?>

    <?php //echo $form->field($model, 'status_id') ?>

    <?php //echo $form->field($model, 'operator_id') ?>

    <?php //echo $form->field($model, 'userNameReal') ?>

    <div class="form-group">
        <?= Html::submitButton('Открыть', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
