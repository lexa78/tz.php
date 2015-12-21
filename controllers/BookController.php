<?php

namespace app\controllers;

use app\models\Author;
use app\models\Searcher;
use DateTime;
use Exception;
use Yii;
use app\models\Book;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * BookController implements the CRUD actions for Book model.
 */
class BookController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['view', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['view'],
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            return ! Yii::$app->user->isGuest;
                        }
                    ],
                    [
                        'actions' => ['update'],
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            return ! Yii::$app->user->isGuest;
                        }
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            return ! Yii::$app->user->isGuest;
                        }
                    ],
                ],
            ],

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ]
        ];
    }

    /**
     * Lists all Book models.
     * @return mixed
     */
    public function actionIndex()
    {
        $session = Yii::$app->session;
        if (! $session->isActive) {
            $session->open();
        }

        $searchParam = $session->get('needSearchParam');

        $searchModel = new Searcher();
        $dataProvider = $searchModel->search($searchParam ? $session->get('searchParam') : Yii::$app->request->get());

        $session->set('needSearchParam', false);
        //        $session->remove('searchParam');
        $session->set('searchParam', Yii::$app->request->get());
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Book model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
/*        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);*/
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Book model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Book();

        if ($model->load(Yii::$app->request->post())) {

            $image = UploadedFile::getInstance($model, 'preview');
            $temp_var = explode(".", $image->name);
            $ext = end($temp_var);

            $date = DateTime::createFromFormat('d F Y', $model->date);
            $model->date = strtotime($date->format('d F Y'));

            $model->preview = Yii::$app->security->generateRandomString() . ".{$ext}";
            $path = Yii::$app->params['uploadPath'] . $model->preview;
            $image->saveAs($path);

            $model->save();

            return $this->redirect(['index']);

        } else {
            return $this->render('create', [
                'model' => $model,
                'author' => Author::find()->all(),
            ]);
        }
    }

    /**
     * Updates an existing Book model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $oldImage = $model->preview;

        if ($model->load(Yii::$app->request->post())) {

            $image = UploadedFile::getInstance($model, 'preview');
            if (! empty($image)) {
                unlink(Yii::$app->params['uploadPath'] . $oldImage);
                $temp_var = explode(".", $image->name);
                $ext = end($temp_var);
                $model->preview = Yii::$app->security->generateRandomString() . ".{$ext}";
                $path = Yii::$app->params['uploadPath'] . $model->preview;
                $image->saveAs($path);
            }

            $date = DateTime::createFromFormat('d F Y', $model->date);
            $model->date = strtotime($date->format('d F Y'));

            $model->save();

            $session = Yii::$app->session;
            if (! $session->isActive) {
                $session->open();
            }
            $session->set('needSearchParam', true);
//            var_dump($session->get('searchParam'));exit;

            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'author' => Author::find()->all(),
            ]);
        }
    }

    /**
     * Deletes an existing Book model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Book model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Book the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Book::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
