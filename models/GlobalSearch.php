<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;
use app\models\Service;

/**
 * ServiceSearch represents the model behind the search form of `app\models\Service`.
 */
class GlobalSearch extends Model
{
    /**
     * {@inheritdoc}
     */
    public $text;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text'], 'safe'],
            [['text'], 'required'],
            [['text'], 'string', 'min' => 1, 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'text' => Yii::t('yii', 'Search'),
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
     * Creates service data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchService($params)
    {
        $query = Service::find();

        // add conditions that should always apply here
        $query->with('user');
        //$query->joinWith(['user']); // for sorting

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
        ]);
        
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            $query->where('0=1');
            return $dataProvider;
        }

        $query->orFilterWhere(['like', 'id', $this->text])
            ->orFilterWhere(['like', 'ip', $this->text])
            ->orFilterWhere(['like', 'domain', $this->text]);

        return $dataProvider;
    }

    /**
     * Creates user data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchUser($params)
    {
        $query = User::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
        ]);
        
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            $query->where('0=1');
            return $dataProvider;
        }

        $query->orFilterWhere(['like', 'id', $this->text])
            ->orFilterWhere(['like', 'first_name', $this->text])
            ->orFilterWhere(['like', 'last_name', $this->text]);

        return $dataProvider;
    }
}
