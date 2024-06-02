<?php
namespace app\models;

use Yii;


date_default_timezone_set('Asia/Jakarta');

/**
 * This is the model class for table "tb_item".
 *
 * @property int $id_item
 * @property string $item_name
 * @property int $item_price
 * @property string $item_type
 * @property string $created_time
 * @property string $updated_time
 *
 * @property TbTransactionDetail[] $tbTransactionDetails
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_name', 'item_price', 'item_type'], 'required'],
            [['item_price'], 'integer'],
            [['item_type'], 'string'],
            [['created_time'], 'default', 'value' => date('Y-m-d H:i:s')],
            [['updated_time'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_item' => 'Id Item',
            'item_name' => 'Item Name',
            'item_price' => 'Item Price',
            'item_type' => 'Item Type',
            'created_time' => 'Created Time',
            'updated_time' => 'Updated Time',
        ];
    }

    /**
     * Gets query for [[TbTransactionDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionDetails()
    {
        return $this->hasMany(TransactionDetail::class, ['id_item' => 'id_item']);
    }
}
