<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Posts;

/**
 * PostsSearch represents the model behind the search form of `backend\models\Posts`.
 */
class PostsSearch extends Posts
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id','status'], 'integer'],
            [['title', 'introduction', 'date', 'author', 'image'], 'safe'],
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
        $query = Posts::find();

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
            'id' => $this->id,
            'date' => $this->date,
            'category_id' => $this->category_id,
            'status'=>$this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'introduction', $this->introduction])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'author', $this->author])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
