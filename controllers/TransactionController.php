<?php

namespace app\controllers;

use Yii;
use app\models\TbTransaction;
use app\models\TransactionSearch;
use app\models\TbTransactionDetail;
use app\models\TbItem;
use app\models\TbBranch;
use app\models\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


/**
 * TransactionController implements the CRUD actions for Transaction model.
 */
class TransactionController extends Controller
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
     * Lists all Transaction models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TransactionSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $this->layout = 'dashboard';

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Transaction model.
     * @param int $id_transaction Id Transaction
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_transaction)
    {
        $transactionItems = TbTransactionDetail::getTransactionDetail($id_transaction);
        $renderArr = [];
        foreach ($transactionItems as $transactionItem) {
            $itemName = TbTransactionDetail::getItemName($transactionItem['id_item']);
            array_push($transactionItem, $itemName[0]['item_name']);
            array_push($renderArr, $transactionItem);
        }
        $this->layout = 'dashboard';
        return $this->render('view', [
            'model' => $this->findModel($id_transaction),
            'detailTransactions' => $renderArr
        ]);
    }

    /**
     * Creates a new Transaction model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $modelsTransactionDetail = [new TbTransactionDetail];
        $itemName = TbItem::getAllItems();
        $branchName = TbBranch::getAllBranches();
        $model = new TbTransaction();
        // echo '<pre>';
        // print_r($_POST);
        // die();
        
        $this->layout = 'dashboard';

        if ($this->request->isPost) {
            // $model->transaction_date = \Yii::$app->formatter->asDate($model->transaction_date, 'yyyy-mm-dd');
            // $model->subtotal = 0;
            $subtotal = 0;
            
            if ($model->load($this->request->post())) {
                $modelsTransactionDetail = Model::createMultiple(TbTransactionDetail::classname());
                if (Model::loadMultiple($modelsTransactionDetail, Yii::$app->request->post())){
                    
                    foreach ($modelsTransactionDetail as $modelTransactionDetail) {
                        $itemPrice = TbTransactionDetail::getItemPrice($modelTransactionDetail->id_item);
                        $itemSubTotal = $modelTransactionDetail->t_item_quantity * $itemPrice;
                        $subtotal += $itemSubTotal;
                        $modelTransactionDetail->created_time = date('Y-m-d H:i:s');
                        $modelTransactionDetail->updated_time = date('Y-m-d H:i:s');

                        $modelTransactionDetail->t_item_price = $itemPrice;
                    }

                    $model->subtotal = $subtotal;

                    if ($model->save()) {
                        $newTransaction = TbTransactionDetail::getLatestTransaction();

                        foreach ($modelsTransactionDetail as $modelTransactionDetail) {
                            $modelTransactionDetail->id_transaction = $newTransaction;
                            $inputItem = [
                                'id_transaction' => $modelTransactionDetail->id_transaction,
                                't_item_price' => $modelTransactionDetail->t_item_price,
                                'id_item' => $modelTransactionDetail->id_item,
                                't_item_quantity' => $modelTransactionDetail->t_item_quantity,
                                'created_time' => $modelTransactionDetail->created_time,
                                'updated_time' => $modelTransactionDetail->updated_time,
                            ];
                            
                            TbTransactionDetail::insertDetail($inputItem);
                        }
                    }

                    return $this->redirect(['view', 'id_transaction' => $model->id_transaction]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'modelsTransactionDetail' => (empty($modelsTransactionDetail)) ? [new TbTransactionDetail] : $modelsTransactionDetail,
            'itemName' => $itemName,
            'branchName' => $branchName
        ]);
    }

    /**
     * Updates an existing Transaction model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_transaction Id Transaction
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_transaction)
    {
        $modelsTransactionDetail = [new TbTransactionDetail];
        $itemName = TbItem::getAllItems();
        $branchName = TbBranch::getAllBranches();
        $this->layout = 'dashboard';
        $model = $this->findModel($id_transaction);


        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_transaction' => $model->id_transaction]);
        }

        return $this->render('update', [
            'model' => $model,
            'modelsTransactionDetail' => (empty($modelsTransactionDetail)) ? [new TbTransactionDetail] : $modelsTransactionDetail,
            'itemName' => $itemName,
            'branchName' => $branchName
        ]);
    }

    /**
     * Deletes an existing Transaction model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_transaction Id Transaction
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_transaction)
    {
        TbTransactionDetail::deleteTransaction('tb_transaction_detail', $id_transaction);
        TbTransactionDetail::deleteTransaction('tb_transaction', $id_transaction);

        return $this->redirect(['index']);
    }

    /**
     * Finds the Transaction model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_transaction Id Transaction
     * @return Transaction the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_transaction)
    {
        if (($model = TbTransaction::findOne(['id_transaction' => $id_transaction])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findDetailModel($id_transaction)
    {
        if (($model = TbTransactionDetail::findAll(['id_transaction' => $id_transaction])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
