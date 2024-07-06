<?php

namespace app\repositories;

use Yii;
use yii\db\Exception;
use yii\db\Query;
use app\models\ImageDecision;

class ImageDecisionRepository
{
    /**
     * Finds all image decisions.
     *
     * @return ImageDecision[]
     */
    public function findAll(): array
    {
        return ImageDecision::find()->all();
    }

    /**
     * Finds all image IDs that have decisions.
     *
     * @return int[]
     */
    public function findAllImageIds(): array
    {
        return (new Query())
            ->select('image_id')
            ->from('image_decision')
            ->column();
    }

    /**
     * Saves a decision for an image.
     *
     * @param int $imageId
     * @param string $decision
     * @return bool
     * @throws Exception
     */
    public function save(int $imageId, string $decision): bool
    {
        $model = new ImageDecision();
        $model->image_id = $imageId;
        $model->decision = $decision;
        Yii::info("Saving decision: $decision for image ID: $imageId", __METHOD__);
        return $model->save();
    }

    /**
     * Deletes an image decision by ID.
     *
     * @param int $id
     * @return int
     * @throws Exception
     */
    public function deleteById(int $id): int
    {
        Yii::info("Deleting decision for image ID: $id", __METHOD__);
        return Yii::$app->db->createCommand()
            ->delete('image_decision', ['id' => $id])
            ->execute();
    }
}
