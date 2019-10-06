<?php
class mysql {
	//Object Variables Please Replace, you can also have them set on the constructor so that you can connect to multiple databases.
	public $status;
	public  $result;
	public  $results;
	private $_host = 'localhost';
	private $_user = 'socialUtopia';
	private $_pass = 'socialUtopia1004';
	private $_db = 'socialUtopia';
	
    function __construct(){
        //Connect To Database
        //Connect using PDO.
        $this->status = new PDO("mysql:host=$this->_host;dbname=$this->_db", $this->_user, $this->_pass);
    }
	
	function checkIt( $query ) {
		$this->query = $this->status->prepare( $query );
        $this->query->execute();
        $row = $this->query->fetch(PDO::FETCH_ASSOC);
		//$this->query->debugDumpParams();
		//var_dump($row);
        if( !$row ) {
            return false;
        } else {
			return true;
		}
	}
	
}