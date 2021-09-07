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

                $data = ArrayHelper::map( $query->select( [ 'DATE( new_case_date ) AS active_date', 'COUNT(*) AS num' ] )
                        ->from( 'reports' )
			->where( 'new_case_date BETWEEN ( NOW() - INTERVAL 30 DAY ) AND NOW()' )
                        ->groupBy( [ 'DATE( new_case_date )' ] )
                        ->orderBy( 'DATE( new_case_date ) ASC' )
                        ->all(),
                        'active_date', 'num'
                );

                $returnData = array();
                array_push( $returnData, [ 'Date', 'New Cases' ] );
                foreach ( $data as $key => $val ) {
                        array_push( $returnData, [ $key, (int) $val ] );
                }

                return $returnData;
	}

	public function getCaseCount() {
		$query = new Query;
		return number_format( $query->select( [ 'id' ] )
			->from( 'reports' )
			->where( 'new_case_date BETWEEN ( NOW() - INTERVAL 30 DAY ) AND NOW()' )
			->count() );
	}
}
