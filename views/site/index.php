<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use scotthuangzl\googlechart\GoogleChart;

$this->title = 'Knox County Schools DIY COVID-19 Dashboard';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">KCS DIY COVID-19 Dashboard</h1>
	<p class="lead">Search for COVID cases in your child's school or report a case of your own.</p>
	<div id="case-container">
		<div id="case-count"><p id="cases"><?= Html::encode( $model->caseCount ) ?></p>New cases in the last 30 days</div>
	</div>
    </div>

    <div class="body-content">

	<div class="chart" id="total-daily-cases">
	<?php
		// Look for a count > 1 here because the first array item is a header row.
                if ( count( $model->dailyCases ) > 1 ) {
			echo GoogleChart::widget( 
				array( 
					'visualization' => 'ColumnChart', 
					'data' => $model->dailyCases,
					'options' => [
						'title' => 'Daily New Cases Reported by Parents, Last 30 Days',
						'height' => 350,
						'colors' => [ '#62b2af' ],
					] 
				) 
			);
		} else {
			echo '<p>This area should contain a chart that shows new cases reported in the last 30 days. If you\'re seeing this message rather than a chart, it means that we do not have any data for the last 30 days. Please check back again later or <a href="mailto:KCSDashboard@gmail.com">let us know</a> if you think there has been a mistake.</p>';
		}
		?>
	</div>

	<div id="map">
	<?php
		/*
		$center = new dosamigos\leaflet\types\LatLng( ['lat' => 35.9875, 'lng' => -83.9420 ] );

		$marker = new \dosamigos\leaflet\layers\Marker(['latLng' => $center, 'popupContent' => 'Hi!']);

		// The Tile Layer (very important)
		$tileLayer = new \dosamigos\leaflet\layers\TileLayer( [
   			'urlTemplate' => 'https://otile{s}.mqcdn.com/tiles/1.0.0/map/{z}/{x}/{y}.png',
    			'clientOptions' => [
        			'attribution' => 'Tiles Courtesy of <a href="http://www.mapquest.com/" target="_blank">MapQuest</a> ' .
        			'<img src="https://developer.mapquest.com/content/osm/mq_logo.png">, ' .
        			'Map data &copy; <a href="https://openstreetmap.org">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
        			'subdomains' => ['1', '2', '3', '4'],
    			],
		] );

		// now our component and we are going to configure it
		$leaflet = new \dosamigos\leaflet\LeafLet([
    			'center' => $center, // set the center
		]);
		
		// Different layers can be added to our map using the `addLayer` function.
		$leaflet->addLayer($marker)      // add the marker
        		->addLayer($tileLayer);  // add the tile layer

		// finally render the widget
		echo \dosamigos\leaflet\widgets\Map::widget(['leafLet' => $leaflet]);
		*/
	?>
	</div>

        <div class="row">
            <div class="col-lg-6">
		<h3>Report</h3>
		<p>Has your child tested positive for COVID? Share relevant (anonymous) details here.</p>
                <p><a class="btn btn-outline-secondary" href="/reports/create">Report a Case</a></p>
            </div>
            <div class="col-lg-6">
		<h3>Cases Near You</h3>
		<p>Looking for reports at your child's school? Search for recent cases here.</p>
                <p><a class="btn btn-outline-secondary" href="/reports/search">Search</a></p>
            </div>
        </div>

    </div>
</div>
