<?php

namespace app\services;

use app\repositories\ImageDecisionRepository;
use yii\db\Exception;
use Yii;

class ImageService
{
    private ImageDecisionRepository $repository;

    public function __construct(ImageDecisionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Gets the next image ID that hasn't been decided yet.
     *
     * @return int|null
     */
    public function getNextImageId(): ?int
    {
        $decidedImages = $this->repository->findAllImageIds();
        $range = range(1, 100); // Static range of values for simplicity
        $availableImages = array_diff($range, $decidedImages);

        Yii::info('Next image ID retrieved', __METHOD__);

        return $availableImages ? $availableImages[array_rand($availableImages)] : null;
    }

    /**
     * Saves the decision for an image.
     *
     * @param int $imageId
     * @param string $decision
     * @return bool
     * @throws Exception
     */
    public function saveDecision(int $imageId, string $decision): bool
    {
        Yii::info("Saving decision for image ID: $imageId with decision: $decision", __METHOD__);

        return $this->repository->save($imageId, $decision);
    }
}
