<?php
/**
 * Created by PhpStorm.
 * User: Александер
 * Date: 17.09.2018
 * Time: 21:38
 */

use yii\helpers\Html;
use yii\widgets\LinkPager;

?>

<h1>Countries</h1>
<ul>
    <?php foreach ($countries as $country): ?>
        <li>
            <?= Html::encode("{$country->code} ({$country->name})") ?>:
            <?= $country->population ?>
        </li>
    <?php endforeach; ?>
</ul>

<?= LinkPager::widget(['pagination' => $pagination]) ?>
