<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;
use yii\jui\DatePicker;

/* @var $this yii\web\View */

$this->title = 'Планирование времени';
$this->params['breadcrumbs'][] = ['label' => 'Список записей', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reception-time">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date')->widget(\yii\widgets\MaskedInput::className(), [
    'mask' => '99.99.9999',]);?>
    <?= $form->field($model, 'date')->input('date'); ?>

    <?= Html::submitButton('Запланировать', ['class' => 'btn btn-primary']); ?>

	<?php ActiveForm::end(); ?>
</div>
