<?PHP
/*
+-------------------------------------------------------+
|Object Call Sign:  <todo_list>         |
|Description:   <todo_list>         |
|Author:    <Name>          |               |
+-------------------------------------------------------+
*/
class  Todo_list{
//------------------Global Allocation-------------------
//------------------Data Structure----------------------


	var $id =-1;
	var $name;
	var $date;
	var $time;


	var $userLastError  = 0;        //Code of the Last raised.

//-----------------Class Infrastructure-----------------
//Validates the values assigned for the object are in the correct format.
//Returns 1 if successful and 0 otherwise.
	function objSafeCheck(){
		return 1;
	}

//Reads a record information to the object'a data structure.
	function readtodo_list(){
		$objDb = new DBBase();
		$strSQL = "SELECT name,date,time FROM todo_list WHERE id = " . $this->id;
		$objDb->dbOpenRecordset($strSQL);
		if ($objDb->dbRecordCount >0){
			if(sizeof($objDb->dbRecordset)){
			$this->name = $objDb->dbRecordset[0][0];
			$this->date = stripslashes($objDb->dbRecordset[0][1]);
			$this->time = stripslashes($objDb->dbRecordset[0][2]);
			
			
		    }
		}
		unset($objDb);
		return 1;
	}

//-----------------Default Constructor--------------------
	function __construct($id=0){
		if($id){
			$this->id = $id;
			$this->readtodo_list();
		}
	}

//deletes a record from the storage.Returns 1 if successful, 0 otherwise.
	function deletetodo_list(){
		$objDb = new hcDBBase();
		$strSQL = "DELETE FROM todo_list WHERE id = " . $this->id;
		$objDb->dbExecute($strSQL);
	}

//Saves a record.Returns 1 if successful, 0 otherwise.
	function savetodo_list(){
			$objDb = new DBBase();
		if($this->id == -1){
		//Inserts the record into the database.
			$strSQL = "INSERT INTO todo_list (name,date,time) " .
				"VALUES('" . $this->name . "','" . addslashes($this->date) . "','" . addslashes($this->time) . "')";
			if($objDb->dbExecute($strSQL)){
				$this->readtodo_list();
				$this->id = $objDb->dbIdentity;
  			// echo $strSQL;
				return 1;
			}
		} else{
		//Updates the record.
			$strSQL = "UPDATE todo_list SET name = '" . addslashes($this->name) . "', date = '" . addslashes($this->date) . "',time = '" . addslashes($this->time) . "' WHERE id = " . $this->id;
			$objDb->dbExecute($strSQL);
			// echo $strSQL;
			return 1;
		}
		return 0;
	}

}
?>
