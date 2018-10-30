<?php
/**
 * Created by PhpStorm.
 * User: Александер
 * Date: 17.09.2018
 * Time: 20:59
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name') ?>
    <?= $form->field($model, 'email') ?>

    <div class="form-group">
        <?= Html::submitButton('Сабмит', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>
