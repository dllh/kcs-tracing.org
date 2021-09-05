<?php

namespace app\models;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use app\models;

class Search extends ActiveRecord {

	public static function tableName() {
		return '{{reports}}';
	}

	public function search( $params ) {
		$where = [];

		$params = $params['Search'];

		if ( isset( $params['school_id'] ) && (int) $params['school_id'] > 0 ) {
			$where['school_id']  = (int) $params['school_id'];
			$this->school_id = (int) $params['school_id'];
		}

		// TODO: Proper validation of grade based on our whitelist.
		if ( isset( $params['grade'] ) && ! empty( $params['grade'] ) ) {
			$where['grade']  = (int) $params['grade'];
			$this->grade = (int) $params['grade'];
		}

		if ( isset( $params['positive_test_date'] ) && ! empty( $params['positive_test_date'] ) ) {
			$where['positive_test_date']  = (int) $params['positive_test_date'];
		}

		if ( isset( $params['symptomatic_date'] ) && ! empty( $params['symptomatic_date'] ) ) {
			$where['symptomatic_date']  = (int) $params['symptomatic_date'];
		}

		$query = Report::find()
			->joinWith( [ 'school' ] )
			->where ( 'schools.id = reports.school_id' )
			->andFilterWhere( $where );

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

	/*
	public function rules() {
		return [
			[[ 'school_id', 'positive_test_date', 'symptomatic_date', 'grade' ], 'required' ],
			[['positive_test_date', 'symptomatic_date'], 'validatePastDate' ],
		];
	}

	
	public function validatePastDate( $attribute, $params ) {
		$date = new \DateTime();
		$maxAgeDate = date_format( $date, 'Y-m-d' );
		
		if ( $this->$attribute > $maxAgeDate ) {
			$this->addError( $attribute, 'Please pick a date that is not in the future.' );
		}
	}

	public function getFormAttributes() {
	    return [
	        // primary key column
	        'id'=>[ // primary key attribute
	            'type' => TabularForm::INPUT_HIDDEN,
	            'columnOptions'=>[ 'hidden' => true ]
		],
		'school_id' => [
			'type' => TabularForm::INPUT_DROPDOWN_LIST,
			'items' => ArrayHelper::map( School::find()->orderBy( 'name' )->asArray()->all(), 'id', 'name' ),
		],
	        'room'=>[
			'type'=>TabularForm::INPUT_DROPDOWN_LIST,
			'items'=>ArrayHelper::map( ClassDetail::find()->distinct( true )->orderBy('room')->asArray(), 'id', 'room'),
			'columnOptions'=>['width'=>'185px']
	        ],
	        'period'=>[
	            'type'=>TabularForm::INPUT_DROPDOWN_LIST,
	            'items'=>ArrayHelper::map( ClassDetail::find()->distinct()->orderBy('period')->asArray()->all(), 'id', 'period'),
	            'columnOptions'=>['width'=>'185px']
	        ],
	    ];
	}
	 */
}
