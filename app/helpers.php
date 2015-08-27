<?php

if ( ! function_exists('setActive'))
{
	function setActive($route, $class = 'active')
	{
		$segments = Request::segments();
		$route = ($route != '') ? explode('.', $route) : array();

		return ($segments === $route) ? $class : ' ';
	    // return (Route::current()->getName() == $route) ? $class : '';
	}
}

if ( ! function_exists('getDescription'))
{
	function getDescription($value)
	{
		$value = strip_tags($value);
		$breaks = array("<br />","<br>","<br/>","<br />","&lt;br /&gt;","&lt;br/&gt;","&lt;br&gt;");
	   	$value = str_ireplace($breaks, "\r\n", $value);

		if (strlen($value) > 250) 
		{
	    	$cutValue = substr($value, 0, 250);
	    	$value = substr($cutValue, 0, strrpos($cutValue, ' ')).'...'; 
		}	
	   	return $value;
	}
}

if ( ! function_exists('activeFilter'))
{
	function activeFilter($status, $class = 'active') {
		$request = \Request::instance();
		$requestStatus = $request->input('status') ?: 'all';

		return ($requestStatus == $status) ? $class : '';
	}
}

if ( ! function_exists('isSelected'))
{
	function isSelected($value1, $value2) {
		return ($value1 == $value2) ? 'selected' : '';
	}
}

if ( ! function_exists('getAmount'))
{
	function getAmount($amount)
	{
		return number_format($amount / 100);
	}
}

if ( ! function_exists('formatDonations'))
{
	function formatDonations($donations)
	{
		$i = 0;
		$arr = [];

		foreach ($donations as $donation) {
            $arr[$i]['day'] = $donation->day+1; // Format: 0-6 => 1-7
            $arr[$i]['hour'] = $donation->hour+1; // Format: 0-23 => 1-24
            $arr[$i]['value'] = round($donation->value / 100); // Cents => Euros
            $i++;
        }

        sort($arr);
        return $arr;
	}
}