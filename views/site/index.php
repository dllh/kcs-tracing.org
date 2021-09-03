<?php

/* @var $this yii\web\View */

use scotthuangzl\googlechart\GoogleChart;

$this->title = 'Knox County Schools DIY Contact Tracing';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">KCS Parent Contact Tracing</h1>
	<p class="lead">Search for COVID cases in your child's school or report a case of your own.</p>
    </div>

    <div class="body-content">

	<div class="chart" id="total-daily-cases">
		<?php
			echo GoogleChart::widget( 
				array( 
					'visualization' => 'LineChart', 
					'data' => $model->dailyCases,
					'options' => [
						'title' => 'Daily Positive Test Cases Reported by Parents, Last 30 Days',
						'hAxis.title' => 'Day',
						'height' => 300,
					] 
				) 
			);
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
		<p>Show a mini form here for searching by school, date, and possibly period and room.</p>
                <p><a class="btn btn-outline-secondary" href="#">Search</a></p>
            </div>
        </div>

    </div>
</div>
