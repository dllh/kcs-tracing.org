<?php

namespace app\models;
use yii\db\ActiveRecord;

class Report extends ActiveRecord {

	public static function tableName() {
		return '{{reports}}';
	}

	public function rules() {
		return [
			[[ 'school_id', 'exposure_id', 'positive_test_date' ], 'required' ],
		];
	}

	public function getSchool() {
		return $this->hasOne( School::class, [ 'id' => 'school_id' ] );
	}

	public function getExposure() {
		return $this->hasOne( Exposure::class, [ 'id' => 'exposure_id' ] );
	}
}
