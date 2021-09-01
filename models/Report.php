<?php

namespace app\models;
use yii\db\ActiveRecord;
use kartik\builder\TabularForm;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use app\models\ClassDetail;

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

	public function getDataProvider() {
		$query = ClassDetail::find();
		$provider = new ActiveDataProvider( [
			'query' => $query,
			'pagination' => [ 'pageSize' => 10 ],
			'sort' => [
				'defaultOrder' => [ 'room' => SORT_ASC, 'period' => SORT_ASC ],
			],
		] );

		return $provider;
		//$classDetails = $provider->getModels();
	}

	public function getFormAttributes() {
	    return [
	        // primary key column
	        'id'=>[ // primary key attribute
	            'type' => TabularForm::INPUT_HIDDEN,
	            'columnOptions'=>[ 'hidden' => true ]
	        ],
	        'room'=>[
	            'type'=>TabularForm::INPUT_DROPDOWN_LIST,
	            'items'=>ArrayHelper::map( ClassDetail::find()->distinct()->orderBy('room')->asArray(), 'id', 'room'),
	            'columnOptions'=>['width'=>'185px']
	        ],
	        'period'=>[
	            'type'=>TabularForm::INPUT_DROPDOWN_LIST,
	            'items'=>ArrayHelper::map( ClassDetail::find()->distinct()->orderBy('period')->asArray()->all(), 'id', 'period'),
	            'columnOptions'=>['width'=>'185px']
	        ],
	    ];
	}
}
