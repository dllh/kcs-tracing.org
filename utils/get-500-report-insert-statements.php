<?php

$zips = array( 37221, 37934, 37938, 37902, 37909, 37912, 37914, 37915, 37916, 37917, 37918, 37919, 37920, 37921, 37922, 37923, 37924, 37931, 37932, 37806, 37849 ,  );
$rooms = array( '201', '101-F', '320', '12', '751-M', 'Vocational', 'Detention', '1200', '1300', '34', '501', '501-A' );

$query = "INSERT INTO reports ( school_id, room, period, positive_test_date, zipcode ) VALUES ( %d, '%s', '%s', '%s', '%s' );\n";

for( $i = 0; $i < 500; $i++ ) {
        $zip = $zips[ array_rand( $zips ) ];
        $room = $rooms[ array_rand( $rooms ) ];

        $date_min = date( 'U', mktime(0, 0, 0, 8, 1, 2021) );
        $date_max = (int) $date_min + 86400 * 31;
        $date = date( 'Y-m-d 00:00:00', rand( $date_min, $date_max ) );

        $school_id = rand( 1, 88 );

        $period = rand( 1, 7 );

        printf( $query, $school_id, $room, $period, $date, $zip );
}
