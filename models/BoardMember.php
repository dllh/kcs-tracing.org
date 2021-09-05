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

	public function getReports() {

		$query = new Query;

                return $query->select( [ 'school_id', 'schools.name AS school_name', 'DATE( active_case_date ) AS active_date', 'grade', 'COUNT(*) AS num' ] )
                        ->from( 'reports, schools' )
                        ->where( 'active_case_date BETWEEN ( NOW() - INTERVAL 30 DAY ) AND NOW() AND reports.school_id = schools.id AND schools.board_member_id = ' . $this->id )
                        ->groupBy( [ 'school_id', 'school_name', 'DATE( active_case_date )', 'grade' ] )
                        ->orderBy( 'school_name, DATE( active_case_date ) DESC, grade, num' )
                        ->all();
        }

        // Daily case data formatted in such a way that it'll work with Google Charts via scotthuangzl/yii2-google-chart.
	public function getDailyCases() {
                $query = new Query;

                $data = ArrayHelper::map( $query->select( [ 'DATE( active_case_date ) AS active_date', 'COUNT(*) AS num' ] )
                        ->from( 'reports, schools' )
                        ->where( 'active_case_date BETWEEN ( NOW() - INTERVAL 30 DAY ) AND NOW() AND reports.school_id = schools.id AND schools.board_member_id = ' . $this->id )
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
