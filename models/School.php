<?php

namespace app\models;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\helpers\ArrayHelper;

class School extends ActiveRecord {

	public static function tableName() {
		return '{{schools}}';
	}

	public function rules() {
		return [
			[[ 'name', ], 'required' ],
			[[ 'address', ], 'required' ],
			[[ 'phone', ], 'required' ],
			[[ 'url', ], 'required' ],
		];
	}

	/*
	 * Different school types support different grade levels. E.g. most high schoolsare grades 9 - 12.
	 * In order to enforce correct grade levels per school, we've classified each set of grade levels
	 * as given in thearray below. We've also added a column to the schools table whose values 
	 * correspond with the array keys below. In the report/save view, we do some fancy javascript
	 * in order to cause selection of a school to limit the grade select box options to valid
	 * subsets of the grades as given below.
	 *
	 * If ever we need to update the grade mappings, we may need to add more types here and update the
	 * schools table's "type" column to match the relevant column.
	 */
	public function getValidGrades( $type = null ) {
		$map = [
			'high'         => [ '9', '10', '11', '12' ],
			'elementary'   => [ 'K', '1', '2', '3', '4', '5' ],
			'intermediate' => [ 'K', '1', '2', '3', '4', '5', '6' ],
			'primary'      => [ 'K', '1', '2', '3', '4', '5', '6' ],
			'middle'       => [ '6', '7', '8' ],
			'unspecified'  => [ 'Pre-K', 'Kindergarten', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12' ],
		];

		if ( 'map' == $type ) {
			return $map;
		} else if ( ! is_null( $type ) && array_key_exists( $type, $map ) ) {
			return $map[ $type ];
		} else {
			return $map[ $this->type ];
		}
	}

	public function getBoardMember() {
                return $this->hasOne( BoardMember::class, [ 'id' => 'board_member_id' ] );
	}

	public function getReports() {
		$query = new Query;
		
		return $query->select( [ 'DATE( new_case_date ) AS active_date', 'grade', 'COUNT(*) AS num' ] )
 			->from( 'reports' )
			->where( 'new_case_date BETWEEN ( NOW() - INTERVAL 30 DAY ) AND NOW() AND school_id = ' . $this->id )
			->groupBy( [ 'DATE( new_case_date )', 'grade' ] )
			->orderBy( 'DATE( new_case_date ) DESC, grade, num' )
			->all();
	}

	// Daily case data formatted in such a way that it'll work with Google Charts via scotthuangzl/yii2-google-chart.
	public function getDailyCases() {
		$query = new Query;
		
		$data = ArrayHelper::map( $query->select( [ 'DATE( new_case_date ) AS active_date', 'COUNT(*) AS num' ] )
 			->from( 'reports' )
			->where( 'new_case_date BETWEEN ( NOW() - INTERVAL 30 DAY ) AND NOW() AND school_id = ' . $this->id )
			->groupBy( [ 'DATE( new_case_date )' ] )
			->orderBy( 'DATE( new_case_date ) ASC' )
			->all(),
			'active_date', 'num'
		);

		$returnData = array();
		array_push( $returnData, [ 'Date', 'New Cases' ] );
                foreach ( $data as $key => $val ) {
			array_push( $returnData, [ $key, (int) $val ] );
                }

                return $returnData;
	}
}
