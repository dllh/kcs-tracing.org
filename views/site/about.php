<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>This dashboard was created by KCS Parents who believe that timely, accurate, actionable data is necessary for parents and guardians to make the best decisions for their families and, ultimately, help slow the spread of COVID-19 in KCS schools and in our community.</p>

<p>KCS provides a “dashboard,” but it has several problems:</p>
<ul class="browser-default">
	<li>Not actionable – Since its revival in late August 2021, the KCS dashboard has displayed the number of active COVID-19 cases (students and teachers) at the district level. This information is not specific enough to be useful to a parent or guardian trying to understand the risk to his or her child of attending school. At the 9/1/21 Board of Education meeting, the Board adopted a resolution to provide a school-based COVID-19 dashboard for 2021-22 school year. Notably, the precise number of cases at each school likely will not be displayed on the new dashboard; instead, for smaller schools, it is likely only ranges will be provided.</li>
	<li>Not transparent – It is unclear what criteria must be met for a case to be counted as “active” on the KCS dashboard. Are cases that are reported directly to a child’s school by a parent included in the dashboard? If so, when are they included?</li>
	<li>Not accurate – The KCS dashboard purports to show the number of active cases, but it is possible (maybe even likely) that there is a significant delay in reporting a case as active, such that the case is only “counted” as an active case for a couple of days.</li>
	<li>Not timely – When the Knox County Health Department receives notification of a positive test result from the state, that positive case only becomes affiliated with a KCS student / employee through the contact tracing interview, assuming the contact tracer is able to contact the parent / guardian. The time elapsed between an individual receiving a positive test result and being contact by a contact tracer can take five days or more.</li>
</ul>

<p>This project seeks to overcome the challenges outlined above through a parent-led effort to produce a school-specific, public-facing dashboard by allowing a parent or guardian of a child who has a confirmed case of COVID-19 to submit a simple report through a web app to automatically update the dashboard.
</p>

<p>You may find the following links helpful:</p>

<ul class="browser-default">
	<li><a href="/reports/create">Create a Report</a></li>
	<li><a href="/site/privacy">Privacy</a></li>
	<!--Contact Us-->
</ul>
</div>
