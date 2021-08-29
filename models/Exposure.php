<?php

namespace app\models;
use yii\db\ActiveRecord;

class Exposure extends ActiveRecord {

	public static function tableName() {
		return '{{exposures}}';
	}

	public function rules() {
		return [
			[[ 'school_id', 'room', 'period', ], 'required' ],
		];
	}
}
