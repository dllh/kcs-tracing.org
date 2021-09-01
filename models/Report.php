<?php

namespace app\models;
use yii\db\ActiveRecord;

class Report extends ActiveRecord {

	public static function tableName() {
		return '{{reports}}';
	}

	public function rules() {
		return [
			[[ 'school_id', 'class_details_id', 'positive_test_date', 'zipcode' ], 'required' ],
		];
	}

	public function getSchool() {
		return $this->hasOne( School::class, [ 'id' => 'school_id' ] );
	}

	public function getClassDetail() {
		return $this->hasOne( ClassDetail::class, [ 'id' => 'class_details_id' ] );
	}
}
