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

function activeFilter($status, $class = 'active') {
	$request = \Request::instance();
	$requestStatus = $request->input('status') ?: 'all';

	return ($requestStatus == $status) ? $class : '';
}

function isSelected($value1, $value2) {
	return ($value1 == $value2) ? 'selected' : '';
}

function getAmount($amount)
{
	return number_format($amount / 100);
}

function getProjectStatus($status) {
	switch ($status)
	{
		case 'completed':
			return 1;

			break;
		case 'active':
			return 0;
			break;
		default:
			return 'all';
			break;
	}
}