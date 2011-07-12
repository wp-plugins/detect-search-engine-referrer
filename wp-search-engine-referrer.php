<?php
/*
Plugin Name: Detect Search Engine Referrer
Plugin URI: http://www.moazam.com
Description: This plugin disable w3 total cache plugin functionality if visitor is coming from search engine.
Version: 0.1
Author: Moazam Nabi
Author URI: http://www.moazam.com/

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

add_action('init', 'wp_check_search_engine_referrer', 1);
$WP_SE_REFERRER = FALSE;
function wp_check_search_engine_referrer() {
	global $WP_SE_REFERRER;
	if(wp_is_search_engine_referrer()) {
		define('DOING_CRON', true);
		$WP_SE_REFERRER = true;
	}
}

function wp_is_search_engine_referrer() {
	$referer = '';
	if(isset($_SERVER['HTTP_REFERER'])) {
		$referer = $_SERVER['HTTP_REFERER'];
	}
	if( preg_match('/www\.google.*/i',$referer)
     || preg_match('/search\.msn.*/i',$referer)
     || preg_match('/search\.yahoo.*/i',$referer)
		 || preg_match('/www\.bing.*/i',$referer)
     || preg_match('/msxml\.excite\.com/i', $referer)
     || preg_match('/search\.lycos\.com/i', $referer)
     || preg_match('/www\.alltheweb\.com/i', $referer)
     || preg_match('/search\.aol\.com/i', $referer)
     || preg_match('/ask\.com/i', $referer)
     || preg_match('/www\.hotbot\.com/i', $referer)
     || preg_match('/www\.metacrawler\.com/i', $referer)
     || preg_match('/search\.netscape\.com/i', $referer)
     || preg_match('/go\.google\.com/i', $referer)
     || preg_match('/dpxml\.webcrawler\.com/i', $referer)
     || preg_match('/search\.earthlink\.net/i', $referer)
     || preg_match('/www\.ask\.co\.uk/i', $referer)) {
		
		$q = trim(str_replace('+',' ',htmlspecialchars($REFERRER['query'])));
		if($q != '') {
			return true;
		}
	}
	return false;
}
?>
