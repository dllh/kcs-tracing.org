<?php

//namespace app\models;
//use yii\db\ActiveRecord;
namespace app\models;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\helpers\ArrayHelper;
//use app\models\Query;

class BoardMember extends ActiveRecord {

	public static function tableName() {
		return '{{board_members}}';
	}

	public function rules() {
		return [
			[[ 'name', ], 'required' ],
			[[ 'email', ], 'required' ],
			[[ 'phone', ], 'required' ],
			[[ 'district', ], 'required' ],
		];
	}

	public function getSchools() {
                return $this->hasMany( School::class, [ 'board_member_id' => 'id' ] );
	}

	/*
	public function getReports() {
		return $this->hasMany( Report::class, [ 'school_id' => 'id' ] )->via( 'schools' );
	}
	 */

	public function getReports() {
                $query = new Query;

                return $query->select( [ 'schools.name AS school_name, DATE( positive_test_date ) AS test_date', 'grade', 'COUNT(*) AS num' ] )
                        ->from( 'reports, schools' )
                        ->where( 'positive_test_date BETWEEN ( NOW() - INTERVAL 30 DAY ) AND NOW() AND reports.school_id = schools.id AND schools.board_member_id = ' . $this->id )
			->groupBy( [ 'school_name', 'test_date', 'grade' ] )
                        ->orderBy( 'school_name ASC, test_date DESC, grade, num' )
                        ->all();
        }

        // Daily case data formatted in such a way that it'll work with Google Charts via scotthuangzl/yii2-google-chart.
        public function getDailyCases() {
                $query = new Query;
                $data = ArrayHelper::map (
                        $query->select( [ 'DATE( positive_test_date ) AS test_date', 'COUNT(*) AS num' ] )
                                ->from( 'reports, schools' )
                               // ->where( 'positive_test_date BETWEEN ( NOW() - INTERVAL 30 DAY ) AND NOW() AND school_id = ' . $this->id )
                        	->where( 'positive_test_date BETWEEN ( NOW() - INTERVAL 30 DAY ) AND NOW() AND reports.school_id = schools.id AND schools.board_member_id = ' . $this->id )
                                ->groupBy( [ 'DATE( positive_test_date )' ] )
                                ->orderBy( 'DATE( positive_test_date ) ASC' )
                                ->all(),
                        'test_date', 'num'
                );

                $returnData = array();
                array_push( $returnData, [ 'Date', 'Positive Tests' ] );
                foreach ( $data as $key => $val ) {
                        array_push( $returnData, [ $key, intVal( $val ) ] );
                }

                return $returnData;
        }
}
