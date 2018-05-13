<?php
class data_mysql
{  
	var $DBHost         = "localhost";
	var $DBPort         = "3306";
	var $DBDatabase     = "traweehorgdb";
	var $DBUser         = "ehsan";
	var $DBPassword     = "ehsan12345";
	var $DBPersistent   = true;
	
	/* date formats */
	var $DATETIME24   = 'Y-m-d H:m:s';
	var $DATETIME12   = ' Y-m-d h:m:s A';
	var $DATE         = 'Y-m-d';
	var $TIME24       = 'H:m:s A';
	var $TIME12        = 'h:m:s A';

	var $AutoFree       = 0;     
	var $LinkID         = 0;
	var $QueryID        = 0;
	var $PageNumber     = 0;
	var $RecordsPerPage = 0;
	var $Record         = array();
	var $Row            = 0;

	var $Errno       = 0;
	var $Error       = "";
	var $HaltOnError = "yes"; // "yes", "no", "report"

	/* public: constructor */
	public function get_values($query)
	{
	    $result=array();
      	$resource = $this->query($query);//returns a resource
		$i=0;
        # Stacking all results in one array
		if($resource)
		while ($row = mysqli_fetch_assoc($resource))
      	{
		    $result[$i] = $row;
       	    $i++;
      	}
        @mysqli_free_result($resource);
		return $result;
	}
		
	public function get_array($query)
	{
	    $result=array();
      	$resource = $this->query($query);//returns a resource
		$i=0;
        # Stacking all results in one array
		if($resource)
	    while ($row = mysqli_fetch_array ($resource))
      	{
		    $result[$i] = $row[0];
       	    $i++;
      	}

	      @mysqli_free_result($resource);
      	return $result;
	}
	function get_fields($table_name)
	{
		$sql = "SHOW COLUMNS FROM " . $table_name;
		$this->query($sql);
		$fields = array();
		while ($row = mysqli_fetch_assoc($this->QueryID))
		{
			if (isset($row['Field']))
			{
				$name = $row['Field'];
			} 
			else 
			{
				$name = '';
			}
			
			if (isset($row['Type']))
			{
				$type = strtoupper($row['Type']);
			} 
			else 
			{
				$type = '';
			}

	if (isset($row['Null']) && (strtoupper($row['Null'])== 'YES'))
			{
				$null = true;
			} 
			else 
			{
				$null = false;
			}

	if (isset($row['Key']) && (strtoupper($row['Key']) == 'PRI'))
			{
				$primary = true;
			} 
			else 
			{
				$primary = false;
			}
	if (isset($row['Key']) && (strtoupper($row['Key']) == 'MUL'))
			{
				$index = true;
			} 
			else 
			{
				$index = false;
			}
	if (isset($row['Extra']) && (strtolower($row['Extra']) == 'auto_increment')){
				$auto_increment = true;
			} else {
				$auto_increment = false;
			}
			if (isset($row['Default'])){
				$default = $row['Default'];
			} else {
				$default = '';
			}
			$field = array('name' => $name, 'type' => $type, 'null' => $null, 'primary' => $primary, 'auto_increment' => $auto_increment, 'default' => $default, 'index' => $index);
			$fields[] = $field;
		}
		return $fields;
		
	}
	
	function single_value($field_name)
	{
//        return mysql_result(mysql_query("SELECT id FROM users WHERE username = '$username'"), 0, 'id');
//        $result = mysqli_query("SELECT id FROM users WHERE username = '$username'");
//        $row = mysqli_fetch_row($result);
//        return $row[0];

		$value=mysql_result($this->QueryID, 0,$field_name);
    	return $value;
	}
	
	function to_sql($value,$value_type, $is_delimiters = true, $use_null = true) 
	{
			switch ($value_type)
			 {
				case NUMBER:
				
					case FLOAT:
					return doubleval(str_replace("," , ".", $value));
					break;
				
					case TEXT:
					//$value = addslashes($value);
					$value=$value;
					break;
				
					case INTEGER:
					return intval($value);
					break;
				
					case DATETIME12:
					  { $value = date($this->DATETIME12); } 
					 
					break;
				
					case DATETIME24:
					 { $value = date($this->DATETIME24); } 
					 
					break;
				
					case DATES:
					  { $value = date($this->DATE); } 
					 
					break;

					case TIME24:
					  { $value = date($this->TIME24); } 
					 
					break;
					
					case TIME12:
					  { $value = date($this->TIME12); } 
					break;
			 }			
		return $value;
	}
	function db_mysql($query = "") 
	{
		$this->RecordsPerPage = 0;
		$this->query($query);
	}

	function check_lib() 
	{
		return function_exists("mysql_connect");
	}

	function connect() 
	{
		if (!$this->LinkID) {
			$server = ($this->DBPort != "") ? $this->DBHost . ":" . $this->DBPort : $this->DBHost;
		
			if ($this->DBPersistent) {
				$this->LinkID = @mysqli_connect("p:".$server, $this->DBUser, $this->DBPassword);
			} else {
				$this->LinkID = @mysqli_connect($server, $this->DBUser, $this->DBPassword);
			}

			if (!$this->LinkID) {		
				$this->halt("Connect failed: " . $this->describe_error(mysqli_errno(), mysqli_error()));
				return 0;
			}
		
			if (!mysqli_select_db($this->DBDatabase, $this->LinkID)) {
				$this->LinkID = 0;
				$this->halt($this->describe_error(mysqli_errno(), mysqli_error()));
				return 0;
			}
		}
		
		return $this->LinkID;
	}

	function free_result()
	{
		if ($this->QueryID) {
			@mysqli_free_result($this->QueryID);
			$this->QueryID = 0;
		}
	}

	function close() 
	{
		if ($this->QueryID) {
			$this->free_result();
		}
		if ($this->LinkID != 0 && !$this->DBPersistent) {
			@mysqli_close($this->LinkID);
			$this->LinkID = 0;
		}
	}

	function query($query_string) 
	{
		 
		if ($query_string == "") {
			return 0;
		}
	
		if (!$this->connect()) {
			return 0; 
		};
	
		if ($this->QueryID) {
			$this->free_result();
		}
	
		if ($this->RecordsPerPage && $this->PageNumber) {
$query_string .= " LIMIT " . (($this->PageNumber - 1) * $this->RecordsPerPage) . ", " . $this->RecordsPerPage;
			$this->RecordsPerPage = 0;
			$this->PageNumber = 0;
		}
	
		$this->QueryID = @mysqli_query($connDoraTarjumaQuran, $query_string, $this->LinkID);
		$this->Row = 0;
		$error=$this->Errno = mysqli_errno();
		$error.=$this->Error = mysqli_error();
		if (!$this->QueryID) {
			return "$error";
		}
		return $this->QueryID;
	}

	public function next_record() 
	{
	    $result=$this->QueryID ;
		$num = mysqli_num_rows( $result );
		if ($num == 1)
		{			
			$this->Record = @mysqli_fetch_array($this->QueryID);
			$this->Row   += 1;
			$this->Errno  = mysqli_errno();
			$this->Error  = mysqli_error();
			$stat = is_array($this->Record);
			if (!$stat && $this->AutoFree) 
			{
				$this->free_result();
			}
			return $stat;
	     	}
	 	else 
		{
			return 0;
		}
	}

	function seek($pos = 0) 
	{
		$status = @mysqli_data_seek($this->QueryID, $pos);
		if ($status) {
			$this->Row = $pos;
		} 
		else {
			$this->halt("seek($pos) failed: result has " . $this->num_rows() . " rows");
			@mysqli_data_seek($this->QueryID, $this->num_rows());
			$this->Row = $this->num_rows;
			return 0;
		}
		return 1;
	}

	function affected_rows() 
	{
		return @mysql_affected_rows($this->LinkID);
	}

	function num_rows() 
	{
		return @mysqli_num_rows($this->QueryID);
	}

	function num_fields() 
	{
		return @mysql_num_fields($this->QueryID);
	}

	function f($Name) 
	{
		if (isset($this->Record[$Name])) 
		{
			$value = $this->Record[$Name];
			return $value; 
		} 
		else 
		{
			return "";
		}
	}
	
	function describe_error($error_code, $error_msg) 
	{
		$error_desc = "";
		switch ($error_code) {
			case 2005: // Unknown MySQL Server Host '...' (11001)
				$error_desc = DB_HOST_ERROR;
				break;
			case 2003: // Can't connect to MySQL server on '...' (10061)
				$error_desc = DB_PORT_ERROR;
				break;
			case 1044: // Access denied for user: '...' to database '...'
				$error_desc = DB_USER_PASS_ERROR . " " . $error_msg;
				break;
			case 1045: // Access denied for user: '...' (Using password: YES)
				$error_desc = DB_USER_PASS_ERROR . " " . $error_msg;
				break;
			case 1049: // Unknown database '...'
				$error_desc = str_replace('{db_name}', $this->DBDatabase, DB_NAME_ERROR);
				break;
			default:
				$error_desc = $error_msg;
		}
		return $error_desc;
	}

	function halt($message) 
	{
		global $t, $is_admin_path, $settings;
	
		if (!$this->Error) 
		{
			$this->Error = $message;
		}
	
		if ($this->HaltOnError == "no") 
		{
			return;
		}
	
//		$request_uri = get_session("REQUEST_URI");
//		$http_host = get_session("HTTP_HOST");
//		$http_referer = get_session("HTTP_REFERER");
//
//		$protocol = (strtoupper(get_session("HTTPS")) == "ON") ? "https://" : "http://";
        $request_uri = $_SERVER["REQUEST_URI"];
        $http_host = $_SERVER["HTTP_HOST"];
        $http_referer = $_SERVER["HTTP_REFERER"];

        $protocol = (strtoupper($_SERVER["HTTPS"]) == "ON") ? "https://" : "http://";
		$page_url = $protocol . $http_host . $request_uri;
		
		$error_message  = "<b>Page URL:</b> <a href=\"" . $page_url . "\">" . $page_url . "</a><br>" ;
		$error_message .= "<b>Referrer URL:</b> <a href=\"" . $http_referer . "\">" . $http_referer . "</a><br>";
		$error_message .= "<b>Database error:</b> " . $message . "<br>" ;
		$error_message .= "<b>MySQL Error:</b> " . $this->Error . "<br>" ;
		
		// to get notification about errors change email address and uncomment mail line below
		$recipients     = "db_error_email@domain_name";
		$subject        = "DB ERROR " . $this->Errno;
		$message        = strip_tags($error_message);
		$email_headers  = "From: db_error_email@domain_name" ;
		$email_headers .= "Content-Type: text/plain";
		// mail($recipients, $subject, $message, $email_headers);
		}
	
	function create_database($db_name = "")
	{
		$resource_id = 0;
		if (strlen($db_name) == 0) {
			$db_name = $this->DBDatabase;
		}
		$server = ($this->DBPort != "") ? $this->DBHost . ":" . $this->DBPort : $this->DBHost;
		if ($this->DBPersistent)
		{
			$resource_id = @mysqli_connect("p:".$server, $this->DBUser, $this->DBPassword);
		} 
		else 
		{
			$resource_id = @mysqli_connect($server, $this->DBUser, $this->DBPassword);
		}

		if (!$resource_id) 
		{		
			$this->halt("Connect failed: " . $this->describe_error(mysqli_errno(), mysqli_error()));
			return 0;
		} 
		else 
		{
			if (mysqli_query("CREATE DATABASE " . $db_name, $resource_id))
			{
				return 1;
			}
			else 
			{
				$this->halt($this->describe_error(mysqli_errno(), mysqli_error()));
				return 0;
			}
		}
	}
}
?>