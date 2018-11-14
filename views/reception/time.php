<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;
use kartik\date\DatePicker;

/* @var $this yii\web\View */

$this->title = 'Планирование времени';
$this->params['breadcrumbs'][] = ['label' => 'Список записей', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reception-time">
	<div class="container">
	
    	<h1><?= Html::encode($this->title) ?></h1>
	
    	<?php $form = ActiveForm::begin(); ?>
    	
        <div class="calendar-form col-md-6">
            <label>Планируемая дата</label>
            <?= DatePicker::widget([
                'options' => ['placeholder' => 'Выберете необходимую дату'],
                'name' => 'Reception[datePlan]',
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'startDate' => date("Y-m-d"),
                    'todayHighlight' => true,
                    'autoclose'=>true,
                    'daysOfWeekDisabled' => [0, 1, 3, 5, 6],
                ]
            ]); ?>
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

