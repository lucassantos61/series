<?php 
namespace Vendor\Factory;

class ConnectionFactory{
	public static function getConnection(){
		
		$con = new \PDO("mysql:host=localhost;dbname=series;","root","123",array(\PDO::ATTR_PERSISTENT => true));
		return $con;
	}
}
