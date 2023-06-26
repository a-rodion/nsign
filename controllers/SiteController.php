<?php
declare(strict_types=1);

namespace app\controllers;

use app\services\DbRowWorker;
use app\services\EmailMessageWorker;
use app\services\SmsMessageWorker;
use app\models\LoginForm;
use app\models\ContactForm;
use app\modules\eventsSubscriptions\behaviors\EventHandlerBehavior;
use app\modules\eventsSubscriptions\models\EventSubscription;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\web\ErrorAction;
use yii\captcha\CaptchaAction;

/**
 *
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'eventRegister' => [
                'class' => EventHandlerBehavior::class,
                'event' => EventSubscription::EVENT_REGISTER,
                'workers' => [
//                    EmailMessageWorker::class,
                    SmsMessageWorker::class,
                ],
            ],
            'eventVerification' => [
                'class' => EventHandlerBehavior::class,
                'event' => EventSubscription::EVENT_VERIFICATION,
                'workers' => [
                    EmailMessageWorker::class,
                    SmsMessageWorker::class,
                    DbRowWorker::class,
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions(): array
    {
        return [
            'error' => [
                'class' => ErrorAction::class,
            ],
            'captcha' => [
                'class' => CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex(): string
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout(): Response
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout(): string
    {
        return $this->render('about');
    }

    /**
     * @return string
     */
    public function actionRegister(): string
    {
        $this->trigger(EventSubscription::EVENT_REGISTER);
        return $this->render('register');
    }

    /**
     * @return string
     */
    public function actionVerification(): string
    {
        $this->trigger(EventSubscription::EVENT_VERIFICATION);
        return $this->render('verification');
    }
}
