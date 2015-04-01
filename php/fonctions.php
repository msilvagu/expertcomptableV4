<?php

//arrondi au multiple de 10 supérieur
	function roundUpToAny($n,$x=10) {
		return (ceil($n)%$x === 0) ? ceil($n) : round(($n+$x/2)/$x)*$x;
	}
	
	//arrondi au multiple de 10
	function custom_round($val, $precision = 10) {
		$output = round($val / $precision);
		return $output * $precision;
	}