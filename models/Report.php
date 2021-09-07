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
			[['positive_test_date', 'symptomatic_date'], 'validatePastDate' ],
		];
	}

	
	public function validatePastDate( $attribute, $params ) {
		$date = new \DateTime();
		$maxAgeDate = date_format( $date, 'Y-m-d' );
		
		if ( $this->$attribute > $maxAgeDate ) {
			$this->addError( $attribute, 'Please pick a date that is not in the future.' );
		}
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


		// Generate and save a guid
		$this->guid = $guid;
		$cookie = new \yii\web\Cookie( [
			'name' => 'guid',
			'value' => $guid,
			'expire' => time() +  86400 * 365, // 1 year
		
		] );

		$response_cookies = \Yii::$app->response->cookies;
		$response_cookies->add( $cookie );


		// Set new_case_date to the earlier of the two submitted dates.
		$positive_test_timestamp = strtotime( $this->positive_test_date );
		$symptomatic_timestamp = strtotime( $this->symptomatic_date );

		if ( (int) $positive_test_timestamp < (int) $symptomatic_timestamp ) {
			$this->new_case_date = $this->positive_test_date;
		} else {
			$this->new_case_date = $this->symptomatic_date;
		}

		// Set active_case_date to new_case_date plus 10 days.
		$this->active_case_date = date( 'Y-m-d H:i:s', strtotime( $this->new_case_date ) + 10 * 86400 );

		return true;
	}
}
