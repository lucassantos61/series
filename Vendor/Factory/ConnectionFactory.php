<?php 
namespace Vendor\Factory;

class ConnectionFactory{
	public static function getConnection(){
		
		$con = new \PDO("mysql:host=localhost;dbname=series;","root","",array(\PDO::ATTR_PERSISTENT => true));
		return $con;
	}
}
