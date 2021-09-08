<?php

for ( $i = 0; $i < 1000; $i++ ) {
	echo "INSERT IGNORE INTO one_time_codes ( code, used ) VALUES( '" . substr( md5( microtime() ), 0, 8 ). "', 0 );\n";
}

