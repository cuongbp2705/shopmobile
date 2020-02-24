<?php
require_once $_SERVER['DOCUMENT_ROOT']."/banhang/config.php";
class goc {
	protected $db;
	function __construct(){
	   $this->db = new mysqli (DB_HOST, DB_USER, DB_PASS, DB_NAME);
	   $this->db->set_charset("utf8"); 
	} 
	//các method
	
} //class goc
