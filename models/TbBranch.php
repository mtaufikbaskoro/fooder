<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tb_branch".
 *
 * @property int $id_branch
 * @property string $branch_name
 * @property string $branch_status
 * @property string $created_time
 * @property string $updated_time
 *
 * @property TbTransaction[] $tbTransactions
 * @property TbUser[] $tbUsers
 */
class TbBranch extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_branch';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['branch_name', 'branch_status'], 'required'],
            [['branch_status'], 'string'],
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
            'id_branch' => 'Id Branch',
            'branch_name' => 'Branch Name',
            'branch_status' => 'Branch Status',
            'created_time' => 'Created Time',
            'updated_time' => 'Updated Time',
        ];
    }

    /**
     * Gets query for [[Transactions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTbTransactions()
    {
        return $this->hasMany(TbTransaction::class, ['id_branch' => 'id_branch']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTbUsers()
    {
        return $this->hasMany(TbUser::class, ['id_branch' => 'id_branch']);
    }

    public static function getAllActiveBranches()
    {
        $branch = TbBranch::find()->where(['branch_status' => 'active'])->all();
        $branch = ArrayHelper::map($branch, 'id_branch', 'branch_name');
        return $branch;
    }
}
