<?php


namespace app\models;


date_default_timezone_set('Asia/Jakarta');

use Yii;
use yii\helpers\ArrayHelper;
use yii\db\Query;

/**
 * This is the model class for table "tb_transaction_detail".
 *
 * @property int $id_transaction_detail
 * @property int $id_transaction
 * @property int $id_item
 * @property int $t_item_quantity
 * @property int $t_item_price
 * @property int $t_item_total
 * @property string $created_time
 * @property string $updated_time
 *
 * @property TbItem $item
 * @property TbTransaction $transaction
 */
class TbTransactionDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_transaction_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_transaction', 'id_item', 't_item_quantity', 't_item_price'], 'required'],
            [['id_transaction', 'id_item', 't_item_quantity', 't_item_price'], 'integer'],
            [['created_time', 'updated_time'], 'default', 'value' => date('Y-m-d H:i:s')],
            [['id_item'], 'exist', 'skipOnError' => true, 'targetClass' => TbItem::class, 'targetAttribute' => ['id_item' => 'id_item']],
            [['id_transaction'], 'exist', 'skipOnError' => true, 'targetClass' => TbTransaction::class, 'targetAttribute' => ['id_transaction' => 'id_transaction']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_transaction_detail' => 'Id Transaction Detail',
            'id_transaction' => 'Id Transaction',
            'id_item' => 'Id Item',
            't_item_quantity' => 'T Item Quantity',
            't_item_price' => 'T Item Price',
            't_item_total' => 'T Item Total',
            'created_time' => 'Created Time',
            'updated_time' => 'Updated Time',
        ];
    }

    /**
     * Gets query for [[Item]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(TbItem::class, ['id_item' => 'id_item']);
    }

    /**
     * Gets query for [[Transaction]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransaction()
    {
        return $this->hasOne(TbTransaction::class, ['id_transaction' => 'id_transaction']);
    }

    public static function getItemPrice($id)
    {
        $rows = (new \yii\db\Query())
            ->select(['item_price'])
            ->from('tb_item')
            ->where(['id_item' => $id])
            ->all();
        $item = $rows[0]['item_price'];
        return $item;
    }

    public static function getItemName($id)
    {
        $rows = (new \yii\db\Query())
            ->select(['item_name'])
            ->from('tb_item')
            ->where(['id_item' => $id])
            ->all();
        return $rows;
    }

    public static function getTransactionDetail($id)
    {
        $rows = (new \yii\db\Query())
            ->select(['id_item', 'id_transaction', 't_item_quantity', 't_item_price'])
            ->from('tb_transaction_detail')
            ->where(['id_transaction' => $id])
            ->all();
        return $rows;
    }

    public static function getLatestTransaction()
    {
        $rows = (new \yii\db\Query())
            ->select(['id_transaction'])
            ->from('tb_transaction')
            ->limit(1)
            ->orderBy(['id_transaction' => SORT_DESC])
            ->all();
        $item = $rows[0]['id_transaction'];
        return $item;
    }

    public static function insertDetail($arr)
    {
        $query = new Query();
        $command = $query->createCommand()->insert('tb_transaction_detail', $arr)->execute();
    }

    public static function deleteTransaction($table, $id)
    {
        $query = new Query();
        $command = $query->createCommand()->delete($table, "id_transaction = $id")->execute();
    }
}
