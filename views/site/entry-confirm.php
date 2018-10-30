<?php
/**
 * Created by PhpStorm.
 * User: Александер
 * Date: 17.09.2018
 * Time: 20:56
 */

use yii\helpers\Html;
?>

<p>Вы ввели следующую информацию:</p>

<ul>
    <li><label>Name: </label><?= Html::encode($model->name) ?></li>
    <li><label>Email: </label><?= Html::encode($model->email) ?></li>
</ul>
