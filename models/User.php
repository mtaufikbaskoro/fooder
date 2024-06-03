<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_user".
 *
 * @property int $id_user
 * @property string $username
 * @property string $password
 * @property string $role
 * @property int $id_branch
 * @property int $created_time
 * @property int $updated_time
 *
 * @property TbBranch $branch
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'role', 'id_branch'], 'required'],
            [['role', 'updated_time'], 'string'],
            [['id_branch'], 'integer'],
            [['created_time'], 'default', 'value' => date('Y-m-d H:i:s')],
            [['username', 'password'], 'string', 'max' => 255],
            [['id_branch'], 'exist', 'skipOnError' => true, 'targetClass' => TbBranch::class, 'targetAttribute' => ['id_branch' => 'id_branch']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_user' => 'Id User',
            'username' => 'Username',
            'password' => 'Password',
            'role' => 'Role',
            'id_branch' => 'Id Branch',
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

    public static function getOldPassword($id)
    {
        $rows = (new \yii\db\Query())
            ->select(['password'])
            ->from('tb_user')
            ->where(['id_user' => $id])
            ->all();
        return $rows;
    }

}
