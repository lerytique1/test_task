<?php

namespace app\controllers;

use yii\db\Exception;
use yii\web\Controller;
use app\repositories\ImageDecisionRepository;
use yii\web\ForbiddenHttpException;
use yii\web\Response;
use Yii;

/**
 * AdminController handles the administrative page.
 */
class AdminController extends Controller
{
    private ImageDecisionRepository $repository;

    public function __construct($id, $module, ImageDecisionRepository $repository, $config = [])
    {
        $this->repository = $repository;
        parent::__construct($id, $module, $config);
    }

    /**
     * Displays the admin page with a list of image decisions.
     *
     * @param string|null $token
     * @return string
     * @throws ForbiddenHttpException
     */
    public function actionIndex(string $token = null): string
    {
        if ($token !== 'xyz123') {
            throw new ForbiddenHttpException('Access denied');
        }

        $decisions = $this->repository->findAll();
        return $this->render('index', ['decisions' => $decisions]);
    }

    /**
     * Reverts the decision for a specific image.
     *
     * @param int $id
     * @return Response
     * @throws Exception
     */
    public function actionRevert(int $id): Response
    {
        Yii::info("Reverting decision for image ID: $id", __METHOD__);
        $this->repository->deleteById($id);

        return $this->redirect(['index', 'token' => 'xyz123']);
    }
}
