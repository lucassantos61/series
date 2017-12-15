<?php
namespace Vendor\Controller;

use Vendor\Lib\View;

class IndexController{
	public function index(){
		return new View('index','Home');
	}
}