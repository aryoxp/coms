<?php

class helper {
	
	public static function getTag($source, $numWords = 10) {
		$tag = preg_replace("/(\-)+/", "-", preg_replace("/[^a-z0-9]/i", "-", strtolower(trim($source))));
		$tag = implode("-", array_slice(explode("-", $tag), 0, $numWords));
		return trim($tag, "-");
	}

	/**
	 * Convert bytes to human readable format
	 * http://codeaid.net/php/convert-size-in-bytes-to-a-human-readable-format-(php)
	 *
	 * @param integer bytes Size in bytes to convert
	 * @return string
	 */
	public static function bytesToSize($bytes, $precision = 2)
	{  
	    $kilobyte = 1024;
	    $megabyte = $kilobyte * 1024;
	    $gigabyte = $megabyte * 1024;
	    $terabyte = $gigabyte * 1024;
	   
	    if (($bytes >= 0) && ($bytes < $kilobyte)) {
	        return $bytes . ' B';
	 
	    } elseif (($bytes >= $kilobyte) && ($bytes < $megabyte)) {
	        return round($bytes / $kilobyte, $precision) . ' KB';
	 
	    } elseif (($bytes >= $megabyte) && ($bytes < $gigabyte)) {
	        return round($bytes / $megabyte, $precision) . ' MB';
	 
	    } elseif (($bytes >= $gigabyte) && ($bytes < $terabyte)) {
	        return round($bytes / $gigabyte, $precision) . ' GB';
	 
	    } elseif ($bytes >= $terabyte) {
	        return round($bytes / $terabyte, $precision) . ' TB';
	    } else {
	        return $bytes . ' B';
	    }
	}
	
}