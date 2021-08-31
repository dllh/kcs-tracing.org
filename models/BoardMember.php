<?php

namespace app\models;
use yii\db\ActiveRecord;

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
}
