<?php
$wgExtensionCredits['parserhook'][] = array(
	'path' => __FILE__,
	'name' => 'MyTwitter',
	'author' => ['[http://www.axllent.org/code/mytwit/ Ralph Slooten]', '페네트-'],
	'version' => '1.0',
	'url' => 'http://wiki-chan.net/',
	'description' => 'Show twitter widget in mediawiki, using Ralph\'s MyTwit class.' ,
	'license-name' => 'MIT'
);

$wgExtensionFunctions[] = 'MyTwitWrapper::registerTwitterTag';
$wgAutoloadClasses['MyTwitWrapper'] = dirname(__FILE__) . '/MyTwitter.class.php';
$wgAutoloadClasses['MyTwit'] = dirname(__FILE__) . '/mytwit.inc.php';

$wgTwitterUser = '';
$wgTwitterConsumerKey = '';
$wgTwitterConsumerSecret = '';
$wgTwitterOAUTHAccessToken = '';
$wgTwitterOAUTHAccessTokenSecret = '';
$wgTwitterCacheExpire = 600;
$wgTwitterPostLimit = 5;
$wgTwitterExcludeReplies = true;
$wgTwitterOpenLinksInBlank = true;