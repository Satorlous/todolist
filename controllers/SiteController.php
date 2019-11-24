<?php

namespace app\controllers;
use app\models\SignupForm;
use app\models\Task;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup', 'tasks'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['tasks'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    return $this->redirect(Url::toRoute('site/index'));
                }
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
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup())
        {
            Yii::$app->session->setFlash('success', 'Регистрация успешно завершена.');
            return $this->goHome();
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
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
            return $this->redirect(Url::toRoute(['site/tasks', 'type' => 'received']));
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
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionTasks($sort_param = null, $type)
    {
        $tasks = Task::find();
        //filter by given $type
        if($type == 'received')
            $tasks= $tasks->where(['responsible_id' => Yii::$app->user->id]);
        else if ($type == 'issued')
            $tasks= $tasks->where(['chief_id' => Yii::$app->user->id]);

          //filter by given $sort_param
        if ($sort_param == null)
            $tasks = $tasks->orderBy(['updated_at' => SORT_DESC]);
        elseif ($sort_param == 'day')
            $tasks = $tasks->andWhere(['between', 'expires_at', time(), time() + 3600*24]);
        elseif ($sort_param == 'week')
            $tasks = $tasks->andWhere(['between', 'expires_at', time(), time() + 3600*24*7]);
        elseif ($sort_param == 'future')
            $tasks = $tasks->andWhere(['>', 'expires_at', time() + 3600*24*7]);

        return $this->render('tasks', [
            'tasks' => $tasks->all(),
        ]);
    }

    public function actionCreateUpdateTask($id = null)
    {
        $model = new Task();
        if($model->load(Yii::$app->request->post()))
        {
            $task = Task::findOne($id);
            if($task->chief->id != Yii::$app->user->id)
            {
                $task->updated_at = time();
                $task->status_id = $model->status_id;
                $task->save();
                Yii::$app->session->setFlash('success', 'Задача обновлена.');
            }
            else
            {
                $task->load(Yii::$app->request->post());
                $task->updated_at = time();
                $task->expires_at = Yii::$app->formatter->asTimestamp($task->expires_at);
                $task->save();
                Yii::$app->session->setFlash('success', 'Задача обновлена.');
            }
        }
        return Yii::$app->request->referrer ? $this->redirect(Yii::$app->request->referrer) : $this->goHome();
    }

    public function actionTest()
    {

    }
}
