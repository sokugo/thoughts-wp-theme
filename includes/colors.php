<?php

class ColorGenerator {

	private static $startColor;
	private static $endColor;
	private static $steps;
	private static $colors;

	private static function interpolate(
		$pBegin, $pEnd, $pStep, $pMax
	) {
		if ( $pBegin < $pEnd ) {
			return ( ( $pEnd - $pBegin ) * ( $pStep / $pMax ) ) + $pBegin;
		} else {
			return ( ( $pBegin - $pEnd ) * ( 1 - ( $pStep / $pMax ) ) ) + $pEnd;
		}
	}

	public static function generate( $start, $end, $steps )
	{
		self::$startColor = hexdec( '0x' . str_replace( '#', '', $start ) );
		self::$endColor   = hexdec( '0x' . str_replace( '#', '', $end ) );

		self::$startColor = ( ( self::$startColor >= 0x000000 ) && ( self::$startColor <= 0xffffff ) ) ?
			self::$startColor : 0x000000;

		self::$endColor = ( ( self::$endColor >= 0x000000 ) && ( self::$endColor <= 0xffffff ) ) ?
			self::$endColor : 0xffffff;

		self::$steps = ( ( $steps > 0 ) && ( $steps < 256 ) ) ? --$steps : 16;

		if (self::$steps > 0) {
			$theR0 = ( self::$startColor & 0xff0000 ) >> 16;
			$theG0 = ( self::$startColor & 0x00ff00 ) >> 8;
			$theB0 = ( self::$startColor & 0x0000ff ) >> 0;

			$theR1 = ( self::$endColor & 0xff0000 ) >> 16;
			$theG1 = ( self::$endColor & 0x00ff00 ) >> 8;
			$theB1 = ( self::$endColor & 0x0000ff ) >> 0;

			for ( $i = 0; $i <= self::$steps; $i ++ ) {
				$theR = self::interpolate( $theR0, $theR1, $i, self::$steps );
				$theG = self::interpolate( $theG0, $theG1, $i, self::$steps );
				$theB = self::interpolate( $theB0, $theB1, $i, self::$steps );

				$color = ( ( ( $theR << 8 ) | $theG ) << 8 ) | $theB;

				self::$colors[] = str_pad( dechex( $color ), 6, '0', STR_PAD_LEFT );
			}
		} else {
			self::$colors[] = str_pad( dechex( self::$startColor ), 6, '0', STR_PAD_LEFT );
		}

		return self::$colors;
	}
}
