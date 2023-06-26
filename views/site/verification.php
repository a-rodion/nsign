<?php
declare(strict_types=1);

/** @var yii\web\View $this */

use yii\bootstrap4\Html;

$this->title = 'Verification';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="body-content">
        Please look at <?=Yii::getAlias('@runtime/logs/info.log')?>
    </div>
</div>
