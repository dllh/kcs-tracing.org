<?php

namespace app\models;
use yii\db\ActiveRecord;
use app\models\School;
use yii\web\Cookie;

class Report extends ActiveRecord {

	public static function tableName() {
		return '{{reports}}';
	}

	public function rules() {
		return [
			[[ 'school_id', 'positive_test_date', 'symptomatic_date', 'grade' ], 'required' ],
		];
	}

	public function getSchool() {
		return $this->hasOne( School::class, [ 'id' => 'school_id' ] );
	}

	public function beforeSave( $insert ) {
		if ( ! parent::beforeSave( $insert ) ) {
			return false;
		}

		// Record the IP address in case we need it in the future to help with spam control.
		$this->ip_address = \Yii::$app->request->getUserIp();

		// Check cookies for a guid. If not found, generate one. Save guid with the report so that we can use it in the future if needed (along with IP, perhaps) to combat spam reports.
		$cookies = \Yii::$app->request->cookies;
		$cookies->readOnly = false;
		if ( isset( $cookies['guid'] ) ) {
			$guid = $cookies['guid']->value;
		} else {
			$guid = uniqid( 'kcst_', true );
		}

		$this->guid = $guid;
		$cookie = new \yii\web\Cookie( [
			'name' => 'guid',
			'value' => $guid,
			'expire' => time() +  86400 * 365, // 1 year
		
		] );

		$response_cookies = \Yii::$app->response->cookies;
		$response_cookies->add( $cookie );

		return true;
	}



	/*
	 * Not currently in use. May be useful later for tabular data form display.
	 */
	/*
	public function getClassDetail() {
		return $this->hasOne( ClassDetail::class, [ 'id' => 'class_details_id' ] );
	}
	 */

	/*
	 * Not currently in use. May be useful later for tabular data form display.
	 */
	/*
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
	 */

	/*
	 * Not currently in use. May be useful later for tabular data form display.
	 */
	/*
	public function getFormAttributes() {
	    return [
	        // primary key column
	        'id'=>[ // primary key attribute
	            'type' => TabularForm::INPUT_HIDDEN,
	            'columnOptions'=>[ 'hidden' => true ]
		],
		'school_id' => [
			'type' => TabularForm::INPUT_DROPDOWN_LIST,
			'items' => ArrayHelper::map( School::find()->orderBy( 'name' )->asArray()->all(), 'id', 'name' ),
		],
	        'room'=>[
			'type'=>TabularForm::INPUT_DROPDOWN_LIST,
			'items'=>ArrayHelper::map( ClassDetail::find()->distinct( true )->orderBy('room')->asArray(), 'id', 'room'),
			'columnOptions'=>['width'=>'185px']
	        ],
	        'period'=>[
	            'type'=>TabularForm::INPUT_DROPDOWN_LIST,
	            'items'=>ArrayHelper::map( ClassDetail::find()->distinct()->orderBy('period')->asArray()->all(), 'id', 'period'),
	            'columnOptions'=>['width'=>'185px']
	        ],
	    ];
	}
	 */
}
