<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Category;

/**
 * CategorySearch represents the model behind the search form of `backend\models\Category`.
 */
class CategorySearch extends Category
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id','status'], 'integer'],
            [['category_name', 'created_by','description'], 'safe'],
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
        $query = Category::find();

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

        $query->joinWith(['staff']);
        
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status'=>$this->status,
        ]);

        $query->andFilterWhere(['like', 'category_name', $this->category_name])
        ->andFilterWhere(['like', 'description', $this->description])
        ->andFilterWhere(['like', 'staff.username', $this->created_by]);

        return $dataProvider;
    }
}
