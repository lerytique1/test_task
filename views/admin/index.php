<?php

/** @var yii\web\View $this */
/** @var app\models\ImageDecision[] $decisions */

use yii\helpers\Html;

$this->title = 'Admin - Image Decisions';
?>

<div class="admin-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Decision</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($decisions as $decision): ?>
            <tr>
                <td><?= Html::a($decision->image_id, "https://picsum.photos/id/$decision->image_id/600/500", ['target' => '_blank']) ?></td>
                <td><?= Html::encode($decision->decision) ?></td>
                <td>
                    <?= Html::a('Revert', ['admin/revert', 'id' => $decision->id, 'token' => 'xyz123'], [
                        'class' => 'btn btn-warning btn-sm',
                        'data' => [
                            'confirm' => 'Are you sure you want to revert this decision?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
