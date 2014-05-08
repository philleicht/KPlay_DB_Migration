<?php

class sql{
	
	private $sqladdress = 'localhost';
	private $sqluser = '';
	private $sqlpass = '';
	

  	public function connect( $dbName ) 
  	{ 
    	do { 
      		$databaseResponse = mysql_connect( $this->sqladdress, $this->sqluser, $this->sqlpass ) or die ('Verbindung konnte nicht hergestellt werden!'); 
 
    	} while( $databaseResponse === false ); 

    		@ $selectResult = mysql_select_db( $dbName ) or die ('Datenbank konnte nicht ge�ffnet werden!'); 
  	} 

  	public function executeQuery( $query, $db ) 
  	{ 
      	if( $db != '' ) db_connect( $db ) or die('Verbindung zur Datenbank fehlgeschlagen!');  

      	$result= mysql_query( $query ); 
      	$err   = mysql_error(); 
      	if( $err != '' ) echo "error=$err  "; 
      	mysql_close(); 
      	return $result; 
  	} 
  	
	function getRows($sql, $dbname)
	{

	$dbcon = $this->connect( $dbname );
	$handle = $this->executeQuery( $sql, $dbcon );	
								  
	if (mysql_num_rows($handle)>0){

		//initialize the array
		$RsArray1 = array();

		//loop thru the recordset
		while ($rows = mysql_fetch_array($handle))
		{
			$RsArray1[] = $rows;
		} //wend
		return $RsArray1;
	}else{
		//no records in recordset so return false
		return false;
	} //end if
	//close the connection
	mysql_close($handle);

	} //end function
  	
}

?>
