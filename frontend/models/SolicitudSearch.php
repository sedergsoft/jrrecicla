<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Solicitud;

/**
 * SolicitudSearch represents the model behind the search form of `frontend\models\Solicitud`.
 */
class SolicitudSearch extends Solicitud
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'clienteid', 'tipo_estado_solicitudid'], 'integer'],
            [['fecha_rec', 'fecha_aprob', 'fecha_ejec', 'status','fecha_solic'], 'safe'],
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
        $query = Solicitud::find();

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
            'fecha_rec' => $this->fecha_rec,
            'fecha_aprob' => $this->fecha_aprob,
            'fecha_ejec' => $this->fecha_ejec,
            'clienteid' => $this->clienteid,
            'tipo_estado_solicitudid' => $this->tipo_estado_solicitudid,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
