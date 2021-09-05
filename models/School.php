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

	public function getBoardMember() {
                return $this->hasOne( BoardMember::class, [ 'id' => 'board_member_id' ] );
	}

	public function getReports() {
		$query = new Query;
		
		return $query->select( [ 'DATE( active_case_date ) AS active_date', 'grade', 'COUNT(*) AS num' ] )
 			->from( 'reports' )
			->where( 'active_case_date BETWEEN ( NOW() - INTERVAL 30 DAY ) AND NOW() AND school_id = ' . $this->id )
			->groupBy( [ 'DATE( active_case_date )', 'grade' ] )
			->orderBy( 'DATE( active_case_date ) DESC, grade, num' )
			->all();
	}

	// Daily case data formatted in such a way that it'll work with Google Charts via scotthuangzl/yii2-google-chart.
	public function getDailyCases() {
		$query = new Query;
		
		$data = ArrayHelper::map( $query->select( [ 'DATE( active_case_date ) AS active_date', 'COUNT(*) AS num' ] )
 			->from( 'reports' )
			->where( 'active_case_date BETWEEN ( NOW() - INTERVAL 30 DAY ) AND NOW() AND school_id = ' . $this->id )
			->groupBy( [ 'DATE( active_case_date )' ] )
			->orderBy( 'DATE( active_case_date ) ASC' )
			->all(),
			'active_date', 'num'
		);

		$returnData = array();
		array_push( $returnData, [ 'Date', 'Active Cases' ] );
                foreach ( $data as $key => $val ) {
			array_push( $returnData, [ $key, (int) $val ] );
                }

                return $returnData;
	}
}
