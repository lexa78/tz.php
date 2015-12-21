<?php
/**
 * Created by PhpStorm.
 * User: Alena
 * Date: 18.07.2015
 * Time: 15:53
 */

namespace app\controllers;

use app\models\UserUpdate;
use Yii;
use app\models\User;
use app\models\UserReg;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
class UserController extends Controller
{
    public function actionReg()
    {
        $model = new UserReg();
       /* var_dump($model);
        exit;*/
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            if (!$model->reg()){
                Yii::$app->session->setFlash('error', 'Возникла ошибка при регистрации.');
                Yii::error('Ошибка при регистрации');
                return $this->refresh();
            }
            return $this->redirect(['book/index',]);
        }
        return $this->render(
            'create',
            [
                'model' => $model
            ]
        );
    }

    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}