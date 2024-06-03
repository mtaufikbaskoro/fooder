<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Transaction;

/**
 * TransactionSearch represents the model behind the search form of `app\models\Transaction`.
 */
class TransactionSearch extends TbTransaction
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_transaction', 'id_branch', 'subtotal'], 'integer'],
            [['transaction_date', 'created_time', 'updated_time'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = TbTransaction::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_transaction' => $this->id_transaction,
            'id_branch' => $this->id_branch,
            'subtotal' => $this->subtotal,
            'transaction_date' => $this->transaction_date,
            'created_time' => $this->created_time,
            'updated_time' => $this->updated_time,
        ]);

        return $dataProvider;
    }
}
