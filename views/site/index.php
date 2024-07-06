<?php

/** @var yii\web\View $this */
/** @var int|null $imageId */

use yii\helpers\Html;

$this->title = 'Random Image';
?>

<div class="site-index">
    <div class="jumbotron text-center">
        <h1 class="display-4">Random Image</h1>
        <?php if ($imageId !== null): ?>
            <p class="lead">
                <img src="https://picsum.photos/id/<?= $imageId ?>/600/500" alt="Random Image" class="img-fluid">
            </p>
            <p>
                <?= Html::a('Approve', ['site/decision', 'id' => $imageId, 'decision' => 'approve'], ['class' => 'btn btn-success']) ?>
                <?= Html::a('Reject', ['site/decision', 'id' => $imageId, 'decision' => 'reject'], ['class' => 'btn btn-danger']) ?>
            </p>
        <?php else: ?>
            <p class="lead">No more images available.</p>
        <?php endif; ?>
    </div>
</div>
