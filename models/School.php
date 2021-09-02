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

	public function getBoardMember() {
                return $this->hasOne( BoardMember::class, [ 'id' => 'board_member_id' ] );
	}

	public function getReports() {
		return $this->hasMany( Report::class, [ 'school_id' => 'id' ] );
	}
}
