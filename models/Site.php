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
	/* 
	 * For this data, we'd like to report the earlier of either symptomatic_date or positive_test_date. 
	 * All the machinations that follow the query accomplish this.
	 *
	 * The $additional_where parameter will be prepended to the WHERE clause. This allows us to use this same
	 * base logic/query from other views with other where clausees to filter by school, board member, etc.
	 */
	public function getDailyCases( $additional_where = '', $from = 'reports' ) {
		$query = new Query;
		$data = $query->select( [ 'DATE( symptomatic_date ) AS symp', 'DATE( positive_test_date ) as test', 'IF( symptomatic_date < positive_test_date, "symp", "test" ) AS earliest_date' ] )
	 			->from( $from )
				->where( $additional_where . '( ( positive_test_date BETWEEN ( NOW() - INTERVAL 30 DAY ) AND NOW() ) OR ( symptomatic_date BETWEEN ( NOW() - INTERVAL 30 DAY ) AND NOW() ) )' )
				->all();

		$dates = array();
		$returnData = array();
		array_push( $returnData, [ 'Date', 'Cases' ] );
		foreach ( $data as $row ) {
			// Add the earlier of the two dates to our data.
			$date = $row[ $row[ 'earliest_date' ] ];

			// Add an array key for the date if one doesn't exist. Value is zero, but we'll increment in the next bit.
			if ( ! array_key_exists( $date, $dates ) ) {
				$dates[ $date ] = 0;
			}

			// Increment the date's count by 1.
			$dates[ $date ]++;
		}

		// Sort by dates.
		ksort( $dates );

		// Push the sorted data onto the final data array.
		foreach ( $dates as $date => $num ) {
			array_push( $returnData, [ $date, (int) $num ] );
		}

		return $returnData;
	}

	public function getReportsByGrade( $additional_where = '', $from = 'reports' ) {
		//return $this->hasMany( Report::class, [ 'school_id' => 'id' ] );

		$query = new Query;
                $data = $query->select( [ 'grade', 'DATE( symptomatic_date ) AS symp', 'DATE( positive_test_date ) as test', 'IF( symptomatic_date < positive_test_date, "symp", "test" ) AS earliest_date' ] )
                                ->from( $from )
                                ->where( $additional_where . '( ( positive_test_date BETWEEN ( NOW() - INTERVAL 30 DAY ) AND NOW() ) OR ( symptomatic_date BETWEEN ( NOW() - INTERVAL 30 DAY ) AND NOW() ) )' )
                                ->all();

		$dates = array();
		$returnData = array();
		//array_push( $returnData, [ 'Date', 'Cases' ] );
		foreach ( $data as $row ) {
			// Add the earlier of the two dates to our data.
			$date = $row[ $row[ 'earliest_date' ] ];

			// Add an array key for the date if one doesn't exist. Value is zero, but we'll increment in the next bit.
			if ( ! array_key_exists( $date, $dates ) ) {
				$dates[ $date ] = [];
			}

			if ( ! array_key_exists( '_'. $row['grade'], $dates[ $date ] ) ) {
				$dates[ $date ][ '_' . $row['grade'] ] = 0;
			}
			// Increment the date's count by 1.
			$dates[ $date ][ '_' . $row['grade'] ]++;
		}
		

		// Sort by dates.
		krsort( $dates );

		// Push the sorted data onto the final data array.
		foreach ( $dates as $date => $grades ) {
			krsort( $grades );
			foreach ( $grades as $grade => $num ) {
				array_push( $returnData, [ 'date' => $date, 'grade' => ltrim( $grade, '_' ), 'num' => (int) $num ] );
			}
		}
		error_log( print_r( $returnData, true ) );

		return $returnData;
	}
}
