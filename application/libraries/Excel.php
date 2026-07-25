<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Excel
{
	public function __construct()
	{
		// Include PHPExcel
		require_once APPPATH . 'libraries/PHPExcel/Classes/PHPExcel.php';
	}
}
