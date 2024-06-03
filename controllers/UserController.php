<?php

namespace app\controllers;

use Yii;

use app\models\User;
use app\models\UserSearch;
use app\models\TbBranch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = 'dashboard';
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        // echo '<pre>';
        // print_r($dataProvider);
        // die();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param int $id_user Id User
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_user)
    {
        $this->layout = 'dashboard';
        return $this->render('view', [
            'model' => $this->findModel($id_user),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $this->layout = 'dashboard';
        $model = new User();
        $branchesAvail = TbBranch::getAllActiveBranches();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->password = Yii::$app->getSecurity()->generatePasswordHash($model->password);
                if($model->save()){
                    return $this->redirect(['view', 'id_user' => $model->id_user]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'branchesAvail' => $branchesAvail
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_user Id User
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_user)
    {
        $this->layout = 'dashboard';
        $model = $this->findModel($id_user);
        $branchesAvail = TbBranch::getAllActiveBranches();

        if ($this->request->isPost && $model->load($this->request->post())) {
            $oldPassword = User::getOldPassword($id_user);
            if (Yii::$app->getSecurity()->validatePassword($_POST['User']['old_password'], $oldPassword[0]['password'])){
                $model->password = Yii::$app->getSecurity()->generatePasswordHash($model->password);
                if ($model->save()) {
                    return $this->redirect(['view', 'id_user' => $model->id_user]);
                }
            } else {
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'branchesAvail' => $branchesAvail,
            'isUpdate' => true
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_user Id User
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_user)
    {
        $this->findModel($id_user)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_user Id User
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_user)
    {
        if (($model = User::findOne(['id_user' => $id_user])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
