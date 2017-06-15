<?php

/**
 * @var $this yii\web\View
 * @var int $number
 * @var float $duration
 */

use yii\helpers\Html;

$this->title = 'News generation';
?>

<div class="site-generation-result">
    <div class="body-content">
        <div class="row">
            Generated <?= $number ?> news in <strong><?= $duration ?> sec.</strong>
        </div>
    </div>
</div>
