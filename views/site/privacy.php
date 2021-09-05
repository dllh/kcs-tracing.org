<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Privacy';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-privacy">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Your privacy and the privacy of your children is important. We collect minimal information in order to make this site function, and we'll share more about that information below. We'll also share a bit about some of the risks associated with using the site. We do believe the risks are small.</p>

    <h3>Things We Collect and Why</h3>
    <p><b>Any data you select via forms or type in yourself.</b><br />We collect this as it's crucial to our contact tracing efforts. Without this data, there is no site.</p>

    <p><b>Your IP address.</b><br />We collect this solely because it can be useful in helping reduce the risk of duplicate or spam submissions.</p>

    <p><b>A short, random alphanumeric string of text.</b><br />This is generated by the server randomly and without incorporating any of the data you send us. We collect it to help with de-duplication of data and to mitigate spam submissions.</p>
	
    <p><b>Browser data.</b></br>Most browsers send along some text called a <a hre="https://en.wikipedia.org/wiki/User_agent">user agent string</a>. Web apps can use this information to determine how to behave for a specific browser. It goes into a web server log along with your IP address. It's collected by default, and we don't use it except insofar as code libraries we've used to build this site may use it to create a better browsing experience</p>

    <h3>Risks</h3>
	
    <p><b>The site could be hacked.</b></br>Since we're not collecting any personally identifiable information about you, we believe the risk here is very small.</p>
	
    <p><b>Software bugs.</b></br>Every piece of software has bugs. This site does (and will never do) anything that should affect your computer, and as above, the very limited scope of data we collect should minimize any risks to you.</p>

</div>
