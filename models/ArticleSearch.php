<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Article;


/**
 * ArticleSearch represents the model behind the search form of `app\models\Article`.
 */
class ArticleSearch extends Article
{

    public function rules()
    {
        return [
            [['id', 'viewed', 'status',], 'integer'],
            [['title', 'annotation', 'content', 'author', 'category_id', 'article_date', 'preview'], 'safe'],
        ];
    }

    public static function tableName()
    {
        return 'article';
    }

    public function scenarios()
    {
        return Model::scenarios();
    }


    public function search($params)
    {
        $query = Article::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 3,
            ],
        ]);


        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->joinWith('category', 'user');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'article_date' => $this->article_date,
            'viewed' => $this->viewed,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'annotation', $this->annotation])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'preview', $this->preview])
            ->andFilterWhere(['like', 'category.title', $this->category_id])
            ->andFilterWhere(['like', 'user.name', $this->author]);

        return $dataProvider;
    }
}
