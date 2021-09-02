<?php

namespace app\models;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\helpers\ArrayHelper;

class Site extends ActiveRecord {

	public static function tableName() {
                return '{{reports}}';
	}

	// Daily case data formatted in such a way that it'll work with Google Charts via scotthuangzl/yii2-google-chart.
	public function getDailyCases() {
		$query = new Query;
		$data = ArrayHelper::map (
			$query->select( [ 'DATE( positive_test_date ) AS test_date', 'COUNT(*) AS num' ] )
	 			->from( 'reports' )
 				->where( 'positive_test_date BETWEEN ( CURDATE() - INTERVAL 30 DAY ) AND CURDATE()' )
				->groupBy( [ 'test_date' ] )
				->orderBy( 'test_date ASC' )
				->all(), 
				'test_date', 'num' );

		$returnData = array();
		array_push( $returnData, [ 'Date', 'Positive Tests' ] );
		foreach ( $data as $key => $val ) {
			array_push( $returnData, [ $key, (int) $val ] );
		}

		return $returnData;
	}

	public function getReports() {
		return $this->hasMany( Report::class, [ 'school_id' => 'id' ] );
	}
}
