<?php

/**
 * @var $this \yii\web\View
 * @var $model \app\models\News
 */

?>

<article>
    <header><?= $model->title ?></header>
    <div class="text"><?= $model->text ?></div>
    <div class="tags">
        <h5>Tags:</h5>
        <ul>
            <?php foreach ($model->tags as $tag): ?>
                <li><?= $tag->name ?> (<?= count($tag->news) ?> more news)</li>
            <?php endforeach; ?>
        </ul>
    </div>
</article>
