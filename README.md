MyTwitter
=========

MyTwitter is Mediawiki extension to embed a Twitter comments into a web page, using Ralph Slooten's MyTwit class. This extension needs Twitter's Oauth and curl commands.

* Website
	* http://www.axllent.org/code/mytwit/    (MyTwit class)
	* https://github.com/wiki-chan/MyTwitter (This extension)
	* http://wiki-chan.net/                  (Example)
* License: MIT-style license (http://opensource.org/licenses/MIT)

## MyTwit ##
MyTwit is a PHP class used to embed a Twitter user's public comments into a web page. It keeps it's own cache, and (by default) updates only every 10 minutes when the page is loaded to prevent overloading twitter (and possibly getting banned). As of version 0.5, it uses an in-built Oauth and curl to fetch feeds.

## Installation ##
Once you have downloaded the code, place the 'Variables' directory within your MediaWiki 'extensions' directory.
```bash
cd /path/to/mediawiki/
cd extensions/
git clone https://github.com/wiki-chan/MyTwitter.git
```
Then add the following code to your LocalSettings.php (see https://www.mediawiki.org/wiki/Manual:LocalSettings.php) file:
```php
# Variables
wfLoadExtension( "MyTwitter" );
```
## Usage ##
On Mediawiki page, use `<twitter/>` tag. You can use `<twitter>ERRORMESSAGE</twitter>` for showing error message in case of error. Built-in css code works only in **Main page**.
