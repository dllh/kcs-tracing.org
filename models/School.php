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
			[[ 'address', ], 'required' ],
			[[ 'phone', ], 'required' ],
			[[ 'url', ], 'required' ],
		];
	}

	public function _____getExposure() {
		return $this->hasMany( Exposure::class, [ 'id' => 'school_id' ] );
	}
}
