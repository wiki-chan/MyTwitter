<?php

class MyTwitWrapper {
	static function registerTwitterTag() {
	    global $wgParser;
	    $wgParser->setHook('twitter', 'MyTwitWrapper::printTwitterTag');

	    return true;
	}

	static function OutputPageParser( OutputPage &$out, ParserOutput $parseroutput ) {
		if ($out->getTitle()->isMainPage()) {
			$out->addModuleStyles('ext.mytwitter.css');
		}
		return true;
	}

	static function printTwitterTag( $input, $params, $parser ) {
		$parser->disableCache();
	    return MyTwitWrapper::getTwit($input);
	}

	static function getTwit( $error ) {
		global $wgTwitterUser, $wgTwitterConsumerKey, $wgTwitterConsumerSecret, $wgTwitterOAUTHAccessToken;
		global $wgTwitterOAUTHAccessTokenSecret, $wgTwitterCacheExpire, $wgTwitterPostLimit, $wgTwitterExcludeReplies, $wgTwitterOpenLinksInBlank;

		$mytwit = new MyTwit();
		$mytwit->TwitterUser = $wgTwitterUser;
		$mytwit->TWITTER_CONSUMER_KEY = $wgTwitterConsumerKey;
		$mytwit->TWITTER_CONSUMER_SECRET = $wgTwitterConsumerSecret;
		$mytwit->TWITTER_OAUTH_ACCESS_TOKEN = $wgTwitterOAUTHAccessToken;
		$mytwit->TWITTER_OAUTH_ACCESS_TOKEN_SECRET = $wgTwitterOAUTHAccessTokenSecret;
		$mytwit->CacheExpire = $wgTwitterCacheExpire;
		$mytwit->PostLimit = $wgTwitterPostLimit;
		$mytwit->ExcludeReplies = $wgTwitterExcludeReplies;
		$mytwit->OpenLinksInBlank = $wgTwitterOpenLinksInBlank;

		$mytwit->UpdateCache();

		$result = '<div class="twitter">';

		if ($mytwit->ErrorMessage) {
			$result .= '<div class="twitter-error">' .
						str_replace("ERRORMESSAGE", $mytwit->ErrorMessage, $error) .
						'</div>';
		} else {
			$result .=
			'<div class="twitter-user">' .
				'<a href="https://twitter.com/' . $mytwit->TwitterUser . '" rel="nofollow">' .
					'<img src="' . $mytwit->UserInfo['user_profile_image_url_https'] . '" alt="' . $mytwit->TwitterUser . '" />' .
				'</a>' .
				'<p class="twitter-user-info">' .
					'<a href="https://twitter.com/' . $mytwit->TwitterUser . '" class="twitter-user-name" rel="nofollow">' . $mytwit->TwitterUser . '</a>' .
					'<span class="twitter-user-desc">' . $mytwit->UserInfo['user_description'] . '</span>' .
				'</p>' .
			'</div>' .
			'<ul class="twitter-post">';

			foreach ($mytwit->Tweets as $tweet) {
				$result .=
				'<li>' . $tweet["MyText"] .
					'<span class="twitter-timestamp">' . 
						'<a href="https://twitter.com/' . $mytwit->TwitterUser . '/status/' . $tweet["id_str"] . '" rel="nofollow">' . self::relative_time($tweet["created_at"]) . '</a>' .
					'</span>' .
				'</li>';
			}

			$result .= '</ul>';
		}

	    $result .= "</div>";

	    return $result;
	}

	static function relative_time($created_at) {
		$created_at = strtotime($created_at);
		$seconds = time() - $created_at;
		$minute = $seconds / 60;
		$hour = $minute / 60;
		$day = $hour / 24;

		if ($day > 365) return date("Y년 n월 j일", $created_at);
		if ($day > 10) return date("n월 j일", $created_at);
		if ($day > 1) return round($day).'일 전';

		if ($hour > 1) return round($hour).'시간 전';

		if ($minute > 1) return round($minute).'분 전';

		return round($seconds).'초 전';
	}
}