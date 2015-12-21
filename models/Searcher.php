<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11.08.15
 * Time: 16:38
 */

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class Searcher extends Book
{
    public function rules()
    {
        // only fields in rules() are searchable
        return [
            [['id', 'name', 'preview','date','created_at','author.last_name'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function attributes()
    {
        // add related fields to searchable attributes
        return array_merge(parent::attributes(), ['author.last_name',]);
    }

    public function search($params)
    {
//        echo '<pre>';
//        print_r($params);
//        exit;

        $query = Book::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'name' => SORT_ASC,
                ]
            ],
        ]);

        // join with relation `whose` that is a relation to the table `user`
        // and set the table alias to be `whose`
        $query->joinWith(['author' => function($query) { $query->from(['author' => 'tz_author']); }]);
        // enable sorting for the related column
        $dataProvider->sort->attributes['author.last_name'] = [
            'asc' => ['author.last_name' => SORT_ASC],
            'desc' => ['author.last_name' => SORT_DESC],
        ];

        // load the search form data and validate
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // adjust the query by adding the filters
        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'author.last_name', $this->getAttribute('author.last_name')]);

        return $dataProvider;
    }
}