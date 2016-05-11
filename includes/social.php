<?php

class Social {
	private static $facebook = 'http://graph.facebook.com/';
	private static $twitter = 'http://urls.api.twitter.com/1/urls/count.json?url=';
	private static $postId;

	static public function getCount( $postId, $url )
	{
		self::$postId = $postId;

		$now        = current_time( 'mysql' );
		$lastUpdate = get_post_meta( $postId, 'social_count_timestamp', true );

		if ( strtotime( $now ) - ( 60 * 10 ) < strtotime( $lastUpdate ) ) {
			return self::loadCount();
		} else {
			$social_count = self::fetchCount( $url );

			self::saveCount( $social_count );

			return $social_count;
		}
	}

	static private function fetchCount( $url )
	{
		$facebookCount = json_decode( self::curl_file_get_contents( self::$facebook . $url ) );
		$twitterCount  = json_decode( self::curl_file_get_contents( self::$twitter . $url ) );

		return $facebookCount->shares + $twitterCount->count;
	}

	static private function saveCount( $data )
	{
		update_post_meta( self::$postId, 'social_count', $data );
		update_post_meta( self::$postId, 'social_count_timestamp', current_time( 'mysql' ) );
	}

	static private function loadCount()
	{
		return get_post_meta( self::$postId, 'social_count', true );
	}

	static private function curl_file_get_contents( $URL )
	{
		$c = curl_init();
		curl_setopt( $c, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $c, CURLOPT_URL, $URL );
		$contents = curl_exec( $c );
		curl_close( $c );

		if ( $contents ) {
			return $contents;
		} else {
			return false;
		}
	}
}
