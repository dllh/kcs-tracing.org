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
		return Site::getReportsBySchoolGrade( 'reports.school_id = schools.id AND schools.board_member_id = ' . $this->id . ' AND ', 'reports, schools', [ 'schools.id AS school_id', 'schools.name AS school_name', 'grade', 'DATE( symptomatic_date ) AS symp', 'DATE( positive_test_date ) as test', 'IF( symptomatic_date < positive_test_date, "symp", "test" ) AS earliest_date' ] );
        }

        // Daily case data formatted in such a way that it'll work with Google Charts via scotthuangzl/yii2-google-chart.
	public function getDailyCases() {
		return Site::getDailyCases( 'reports.school_id = schools.id AND schools.board_member_id = ' . $this->id . ' AND ', 'reports, schools' );
        }
}
