<?PHP 
/*
+-------------------------------------------------------+
|Object Call Sign:		DBTemplate			              	|
|																												|
|This objects intended to be a data mangment object for |
|mysql databases.																				| 
|																												|
|Version:		1.0.0																																							
+-------------------------------------------------------+		*/																														

class DBBase{
//----------------Global Allocation----------------------
    public $dbRecordset = array();
	var $dbLastError  = 0;		//Last error occured.
	var $dbRowsAfftected = 0;
	var $dbIdentity = 0;
	var $dbPageSize = 0;
	var $dbCurrentPage = 0;
	var $dbRecordCount = 0;
	var $dbPageCount = 0;
	public $result = array();

	
	function dbOpenRecordset($strSource)
	{
	    $dbhandle = mysqli_connect($_SESSION["HOST_ADDRESS"], $_SESSION["HOST_USER"], $_SESSION["HOST_PASSWORD"]);
	    if ($dbhandle) {
	        mysqli_select_db($dbhandle, $_SESSION["HOST_DATABASE"]);

	        $results = mysqli_query($dbhandle, $strSource);
	        $this->dbRecordCount = mysqli_affected_rows($dbhandle);

	        if ($this->dbPageSize) {
	            if ($this->dbCurrentPage) {
	                $strSource .= " LIMIT " . ($this->dbCurrentPage - 1) * $this->dbPageSize . "," . $this->dbPageSize;
	            } else {
	                $strSource .= " LIMIT " . $this->dbCurrentPage . "," . $this->dbPageSize;
	            }
	            $results = mysqli_query($dbhandle, $strSource);
	            $this->dbPageCount = $this->dbRecordCount / $this->dbPageSize;
	            $this->dbPageCount = (int) $this->dbPageCount;
	            if ($this->dbRecordCount % $this->dbPageSize) {
	                $this->dbPageCount++;
	            }
	        }

	        if ($results) {
	            $i = 0;
	            while ($row = mysqli_fetch_array($results)) {
	                $this->dbRecordset[$i] = $row;
	                $i++;
	            }
	            mysqli_free_result($results);
	        }

	        mysqli_close($dbhandle);
	    } else {
	        return 0;
	    }
	}

	function dbExecute($strCommand) {
	    $connection = mysqli_connect($_SESSION["HOST_ADDRESS"], $_SESSION["HOST_USER"], $_SESSION["HOST_PASSWORD"], $_SESSION["HOST_DATABASE"]);
	    if ($connection) {
	        $result = mysqli_query($connection, $strCommand);
	        if ($result) {
	            $this->dbRowsAffected = mysqli_affected_rows($connection);
	            if (strpos(strtoupper($strCommand), "INSERT") !== false) {
	                $this->dbIdentity = mysqli_insert_id($connection);
	            }
	            mysqli_close($connection);
	            return 1;
	        } else {
	            mysqli_close($connection);
	            return 0;
	        }
	    }
	}
}


?>
