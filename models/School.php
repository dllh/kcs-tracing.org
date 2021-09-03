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
		//return $this->hasMany( Report::class, [ 'school_id' => 'id' ] );
		//select room, period, DATE( positive_test_date ) AS test_date, COUNT(*) AS num FROM reports WHERE school_id = 1 GROUP BY room, period, test_date ORDER BY test_date DESC, room, num;
		$query = new Query;
		
		return $query->select( [ 'DATE( positive_test_date ) AS test_date', 'room', 'period', 'COUNT(*) AS num' ] )
 			->from( 'reports' )
			->where( 'positive_test_date BETWEEN ( CURDATE() - INTERVAL 30 DAY ) AND CURDATE() AND school_id = ' . $this->id )
			->groupBy( [ 'test_date', 'room', 'period' ] )
			->orderBy( 'test_date DESC, room, period, num' )
			->all();
	}

	// Daily case data formatted in such a way that it'll work with Google Charts via scotthuangzl/yii2-google-chart.
        public function getDailyCases() {
                $query = new Query;
                $data = ArrayHelper::map (
                        $query->select( [ 'DATE( positive_test_date ) AS test_date', 'COUNT(*) AS num' ] )
                                ->from( 'reports' )
                                ->where( 'positive_test_date BETWEEN ( CURDATE() - INTERVAL 30 DAY ) AND CURDATE() AND school_id = ' . $this->id )
                                ->groupBy( [ 'test_date' ] )
                                ->orderBy( 'test_date ASC' )
                                ->all(),
			'test_date', 'num' 
		);

                $returnData = array();
                array_push( $returnData, [ 'Date', 'Positive Tests' ] );
                foreach ( $data as $key => $val ) {
                        array_push( $returnData, [ $key, (int) $val ] );
                }

                return $returnData;
        }
}
