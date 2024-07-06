<?php

namespace app\controllers;

use yii\db\Exception;
use yii\web\Controller;
use app\services\ImageService;
use app\requests\ImageDecisionRequest;
use yii\web\Response;
use Yii;

/**
 * SiteController handles the main page and image decisions.
 */
class SiteController extends Controller
{
    private ImageService $imageService;

    public function __construct($id, $module, ImageService $imageService, $config = [])
    {
        $this->imageService = $imageService;
        parent::__construct($id, $module, $config);
    }

    /**
     * Displays the main page with a random image.
     *
     * @return string
     */
    public function actionIndex(): string
    {
        $imageId = $this->imageService->getNextImageId();
        return $this->render('index', ['imageId' => $imageId]);
    }

    /**
     * Handles the decision (approve/reject) for the displayed image.
     *
     * @param int $id
     * @param string $decision
     * @return Response
     * @throws Exception
     */
    public function actionDecision(int $id, string $decision): Response
    {
        $request = new ImageDecisionRequest(['image_id' => $id, 'decision' => $decision]);
        if ($request->validate()) {
            Yii::info("Decision received for image ID: $id with decision: $decision", __METHOD__);
            $this->imageService->saveDecision($request->image_id, $request->decision);
        }

        return $this->redirect(['index']);
    }
}
