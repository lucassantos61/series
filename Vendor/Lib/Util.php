<?php
namespace Vendor\Lib;
use Vendor\Model\Serie;

class Util{
	public static function popula($objeto, array $array){
		foreach ($array as $key => $value) {
			$metodo = "set".ucfirst(strtolower($key));
			$objeto->$metodo($value);
		}
		return $objeto;
	}
}