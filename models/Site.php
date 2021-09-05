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

	public function getReportByQuery( $additional_where = '', $from = 'reports', $select = array() ) {
		$query = new Query;

		if ( empty( $select ) ) {
			$select = [ 'grade', 'DATE( symptomatic_date ) AS symp', 'DATE( positive_test_date ) as test', 'IF( symptomatic_date < positive_test_date, "symp", "test" ) AS earliest_date' ];
		}
		return $query->select( $select )
                                ->from( $from )
                                ->where( $additional_where . '( ( positive_test_date BETWEEN ( NOW() - INTERVAL 30 DAY ) AND NOW() ) OR ( symptomatic_date BETWEEN ( NOW() - INTERVAL 30 DAY ) AND NOW() ) )' )
                                ->all();


	}

	public function getReportsBySchoolGrade( $additional_where = '', $from = 'reports', $select = array() ) {

		$data = Site::getReportByQuery( $additional_where, $from, $select );
		$returnData = array();

		$schools = array();

		foreach ( $data as $row ) {
			
			// Add the earlier of the two dates to our data.
			$date = $row[ $row[ 'earliest_date' ] ];

			// Populate a nested associative array with data that we can then format in a way that the view wants to see it.
			if ( ! array_key_exists( $row['school_name'], $schools )) {
				$schools[ $row['school_name']] = [];
				$schools[ $row['school_name']]['school_id'] = $row['school_id'];
				$schools[ $row['school_name']]['dates'] = [];
			}

			if ( ! array_key_exists( $date, $schools[ $row['school_name']]['dates'] ) ) {
				$schools[ $row['school_name']]['dates'][ $date ] = [];
			}

			if ( ! array_key_exists( '_' . $row['grade'], $schools[ $row['school_name']]['dates'][ $date ] ) ) {
				$schools[ $row['school_name']]['dates'][ $date ][ '_' . $row['grade']] = 0;
			}

			$schools[ $row['school_name']]['dates'][ $date ][ '_' . $row['grade']]++;


		}
		

		// Sort by school name.
		ksort( $schools );

		// Push the sorted data onto the final data array that matches what the view requires.
		foreach ( $schools as $school_name => $data ) {
			krsort( $data['dates'] );
			foreach ( $data['dates'] as $date => $grades ) {
				foreach ( $grades as $grade => $num ) {
					array_push( $returnData, [ 'date' => $date, 'school_name' => $school_name, 'school_id' => $data['school_id'], 'grade' => ltrim( $grade, '_' ), 'num' => (int) $num ] );
				}
			}
		}
		return $returnData;
	}

	public function getReportsByGrade( $additional_where = '', $from = 'reports' ) {
		$data = Site::getReportByQuery( $additional_where, $from );
		
		$dates = array();
		$returnData = array();

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
