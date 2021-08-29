<?php

namespace app\models;
use yii\db\ActiveRecord;

class School extends ActiveRecord {

	public static function tableName() {
		return '{{schools}}';
	}

	public function rules() {
		return [
			[[ 'name', ], 'required' ],
		];
	}

	public function _____getExposure() {
		return $this->hasMany( Exposure::class, [ 'id' => 'school_id' ] );
	}
}
