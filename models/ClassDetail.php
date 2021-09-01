<?php

namespace app\models;
use yii\db\ActiveRecord;

class ClassDetail extends ActiveRecord {

	public static function tableName() {
		return '{{class_details}}';
	}

	public function rules() {
		return [
			[[ 'school_id', 'room', 'period', ], 'required' ],
		];
	}

	public function getSchool() {
		return $this->hasOne( School::class, [ 'id' => 'school_id' ] );
	}
}
