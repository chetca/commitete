<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;

/* @var $this yii\web\View */

$this->title = 'Планирование времени';
$this->params['breadcrumbs'][] = ['label' => 'Список записей', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reception-time">
	<div class="container">
	
    	<h1><?= Html::encode($this->title) ?></h1>
	
    	<?php $form = ActiveForm::begin(); ?>
    	<div class="col-md-4">
    		<?= $form->field($model, 'datePlan')->input('date'); ?>
    	</div>

    	<div class="col-md-4">
    		<?= $form->field($model, 'operatorPlan')->dropDownList([
    			'1' => 'Один',
    			'2' => 'Два', 
    			'3' => 'Три'
    		], 
    		[
    			'options' => [
    				'2' => ['Selected' => true]
    			]
    		]
    	); ?>
    	</div>
    </div> 	
	<div class="container">
		<?= Html::submitButton('Запланировать', ['class' => 'btn btn-primary']); ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>

