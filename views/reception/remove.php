<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;

/* @var $this yii\web\View */

$this->title = 'Удаление записей';
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
                '0' => 'Весь день',
    			'1' => 'Первый',
    			'2' => 'Второй', 
    			'3' => 'Третий'
    		], 
    		[
    			'options' => [
    				'3' => ['Selected' => true]
    			]
    		]
    	); ?>
    	</div>
    </div> 	
	<div class="container">
		<?= Html::submitButton('Удалить', 
        [
            'class' => 'btn btn-danger'
        ]); ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>

