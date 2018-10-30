<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Reception */

$this->title = 'Create Reception';
$this->params['breadcrumbs'][] = ['label' => 'Receptions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reception-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
