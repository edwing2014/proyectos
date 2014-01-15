<?php

//http://localhost/iweb2012/examples/config_management/sitio/edit/1

class Config_Model  extends CI_Model  {
    
	protected $primary_key = null;
	protected $table_name = null;
	protected $relation = array();
	protected $relation_n_n = array();
	protected $primary_keys = array();
	
	function __construct()
    {
        parent::__construct();
    	$this->load->helper('url');
	
	}
	
	function get_config_data(){		
	$query = $this->db->query("SELECT * FROM config where id = '1'");	
	$config_data = $query->row();		
	
	if(count($config_data) <= 0){
		echo "Error fatal, no se han configurado los parametros de configuracion del sistema<br>";
		$config_data = array();	
	}
	//print_r($config_data);die();	
	return	$config_data;		
	}
	
	function urls_amigables($url) {

	// Tranformamos todo a minusculas

	$url = strtolower($url);

	//Rememplazamos caracteres especiales latinos

	$find = array('/Ã¡/', '/Ã©/', '/Ã­/', '/Ã³/', '/Ãº/', '/Ã±/', '/ÃƒÂ¡/', '/ÃƒÂ©/', '/Ãƒ*/', '/ÃƒÂ³/', '/ÃƒÂº/', '/Ã¤/', '/Ã«/', '/Ã¯/', '/Ã¶/', '/Ã¼/', '/ÃƒÂ¤/', '/ÃƒÂ«/', '/ÃƒÂ¯/', '/ÃƒÂ¶/', '/ÃƒÂ¼/', '/ÃƒÂ?/', '/Ãƒâ€°/', '/ÃƒÂ?/', '/Ãƒâ€œ/', '/ÃƒÅ¡/', '/Ãƒâ€ž/', '/Ãƒâ€¹/', '/ÃƒÂ?/', '/Ãƒâ€“/', '/ÃƒÅ“/', '/ÃƒÂ±/');

	$repl = array('a', 'e', 'i', 'o', 'u', 'n', 'a',  'e',  'i',  'o',  'u',  'a', 'e', 'i', 'o', 'u', 'a',  'e',  'i',  'o',  'u',  'a',  'e',  'i',  'o',  'u',  'a',  'e',  'i',  'o',  'u',  'n');

	//$url = ereg_replace ($find, $repl, $url);
$url = preg_replace ($find, $repl, $url);
	// AÃ±aadimos los guiones

	$find = array(' ', '&', '\r\n', '\n', '+'); 

	$url = str_replace ($find, '-', $url);

	// Eliminamos y Reemplazamos demÃ¡s caracteres especiales

	$find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');

	$repl = array('', '-', '');

	$url = preg_replace ($find, $repl, $url);

	//echo $url."<br>";

	//$this->freturn = $url;

	if($url != ''){
	return $url.'.html';
	}else{
	return $url;	
	}

	}
	
	
}
?>