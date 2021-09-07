<?php

namespace app\models;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use app\models;

class Search extends ActiveRecord {

	public $start_date;
	public $end_date;

	public static function tableName() {
		return '{{reports}}';
	}

	public function search( $params ) {
		$where = [];
		$filterWhere = [];


		if ( isset( $params['Search'] ) ) {
			$params = $params['Search'];
		} else {
			return [];
		}

		if ( isset( $params['school_id'] ) && (int) $params['school_id'] > 0 ) {
			$filterWhere['school_id']  = (int) $params['school_id'];
			$this->school_id = (int) $params['school_id'];
		}

		// TODO: Proper validation of grade based on our whitelist.
		if ( isset( $params['grade'] ) && ! empty( $params['grade'] ) ) {
			$filterWhere['grade']  = $params['grade'];
			$this->grade = $params['grade'];
		}

		if ( isset( $params['start_date'] ) && ! empty( $params['start_date'] ) ) {
			$this->start_date = $params['start_date'];
		}

		if ( isset( $params['end_date'] ) && ! empty( $params['end_date'] ) ) {
			$this->end_date = $params['end_date'];
		}

		$query = Report::find()
			->joinWith( [ 'school' ] )
			->where ( 'schools.id = reports.school_id' )
			->andWhere( $where )
			->andFilterWhere( $filterWhere )
			->andFilterWhere( [ 'between', 'new_case_date', $params['start_date'], $params['end_date'] ] );

		$dataProvider = new ActiveDataProvider( [
			'query' => $query,
		] );

		// Load the search form data and validate
		if ( ! ( $this->load( $params ) && $this->validate() ) ) {
            		return $dataProvider;
		}


        	return $dataProvider;
	}

	public function getSchool() {
                return $this->hasOne( School::class, [ 'id' => 'school_id' ] );
	}

}
