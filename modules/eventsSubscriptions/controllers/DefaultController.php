<?php
declare(strict_types=1);

namespace app\modules\eventsSubscriptions\controllers;

use yii\web\Controller;

/**
 * Default controller for the `events` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex(): string
    {
        return $this->render('index');
    }
}
