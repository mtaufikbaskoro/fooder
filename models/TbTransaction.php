<?php

namespace app\models;

date_default_timezone_set('Asia/Jakarta');

use Yii;

/**
 * This is the model class for table "tb_transaction".
 *
 * @property int $id_transaction
 * @property int $id_branch
 * @property int $subtotal
 * @property string $transaction_date
 * @property string $created_time
 * @property string $updated_time
 *
 * @property TbBranch $branch
 * @property TbTransactionDetail[] $tbTransactionDetails
 */
class TbTransaction extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_transaction';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_branch', 'transaction_date'], 'required'],
            [['id_branch', 'subtotal'], 'integer'],
            [['created_time'], 'default', 'value' => date('Y-m-d H:i:s')],
            [['updated_time'], 'string'],
            [['id_branch'], 'exist', 'skipOnError' => true, 'targetClass' => TbBranch::class, 'targetAttribute' => ['id_branch' => 'id_branch']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_transaction' => 'Id Transaction',
            'id_branch' => 'Id Branch',
            'subtotal' => 'Subtotal',
            'transaction_date' => 'Transaction Date',
            'created_time' => 'Created Time',
            'updated_time' => 'Updated Time',
        ];
    }

    /**
     * Gets query for [[Branch]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTbBranch()
    {
        return $this->hasOne(TbBranch::class, ['id_branch' => 'id_branch']);
    }

    /**
     * Gets query for [[TbTransactionDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTbTransactionDetails()
    {
        return $this->hasMany(TbTransactionDetail::class, ['id_transaction' => 'id_transaction']);
    }
}
