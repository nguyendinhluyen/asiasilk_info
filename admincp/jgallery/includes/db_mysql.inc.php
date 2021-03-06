<?php
/*
 * Session Management for PHP3
 *
 * Copyright (c) 1998-2000 NetUSE AG
 *                    Boris Erdmann, Kristian Koehntopp
 *
 * $Id: db_mysql.inc,v 1.2 2000/07/12 18:22:34 kk Exp $
 *
 */ 
class DB_Sql{
   

  var $Host     = "localhost";
  var $Database = "nanapet12_usr";
  var $User     = "nanapet12_db";
  var $Password = "GLSPxR8r";
  
   /* public: configuration parameters */
  var $Auto_Free     = 0;     ## Set to 1 for automatic mysql_free_result()
  var $Debug         = 0;     ## Set to 1 for debugging messages.
  var $Halt_On_Error = "report"; ## "report" (halt with message), "no" (ignore errors quietly), "report" (ignore errror, but spit a warning)
  var $Seq_Table     = "records";

  /* public: result array and current row number */
  var $Record   = array();
  var $Row;

  /* public: current error number and error text */
  var $Errno    = 0;
  var $Error    = "";

  /* public: this is an api revision, not a CVS revision. */
  var $type     = "mysql";
  var $revision = "1.2";

  /* private: link and query handles */
  var $Link_ID  = 0;
  var $Query_ID = 0;
  

  var $sql_query_string ="";

  /* public: constructor */
  function DB_Sql($query = "") {
      $this->query($query);
  }

  /* public: some trivial reporting */
  function link_id() {
    return $this->Link_ID;
  }

  function query_id() {
    return $this->Query_ID;
  }

  /* public: connection management */
  function connect($Database = "", $Host = "", $User = "", $Password = "") {
    /* Handle defaults */
    if ("" == $Database)
      $Database = $this->Database;
	  //$Database = $this->db;
    if ("" == $Host)
      $Host     = $this->Host;
	  //$Host     = $this->host;
	  
    if ("" == $User)
      $User     = $this->User;
	  //$User     = $this->user;
    if ("" == $Password)
      $Password = $this->Password;
      //$Password = $this->password;
	  
    /* establish connection, select database */
    if ( 0 == $this->Link_ID ) {
    
      $this->Link_ID=mysql_connect($Host, $User, $Password);
      if (!$this->Link_ID) {
        $this->halt("pconnect($Host, $User, \$Password) failed.");
        return 0;
      }

      if (!@mysql_select_db($Database,$this->Link_ID)) {
        $this->halt("cannot use database ".$this->Database);
        return 0;
      }
    }
    
    return $this->Link_ID;
  }

  /* public: discard the query result */
  function free() {
      @mysql_free_result($this->Query_ID);
      $this->Query_ID = 0;
  }
 
 
  /* public: perform a query */
  function query($Query_String) {
    /* No empty queries, please, since PHP4 chokes on them. */
    if ($Query_String == "")
      /* The empty query string is passed on from the constructor,
       * when calling the class without a query, e.g. in situations
       * like these: '$db = new DB_Sql_Subclass;'
       */
      return 0;

    if (!$this->connect()) {
      return 0; /* we already complained in connect() about that. */
    };

    # New query, discard previous result.
    if ($this->Query_ID) {
      $this->free();
    }

    if ($this->Debug)
      printf("Debug: query = %s<br>\n", $Query_String);
	$this->sql_query_string = $Query_String;
    $this->Query_ID = @mysql_query($Query_String,$this->Link_ID);
    $this->Row   = 0;
    $this->Errno = mysql_errno();
    $this->Error = mysql_error();
    if (!$this->Query_ID) {
      $this->halt("Invalid SQL: ".$Query_String);
    }

    # Will return nada if it fails. That's fine.
    return $this->Query_ID;
  }
	function current_row()
	{
	return $this->Row;
	}
  	function query_next($Query_String) 
	{
		$this->query($Query_String) ;
		return $this->next_record();
	}
  /* public: walk result set */
  function next_record() {
    if (!$this->Query_ID) {
      $this->halt("next_record called with no query pending.");
      return 0;
    }

    $this->Record = @mysql_fetch_array($this->Query_ID);
    $this->Row   += 1;
    $this->Errno  = mysql_errno();
    $this->Error  = mysql_error();

    $stat = is_array($this->Record);
    if (!$stat && $this->Auto_Free) {
      $this->free();
    }
 
    return $stat;
  }

  /* public: position in result set */
  function seek($pos = 0) {
    $status = @mysql_data_seek($this->Query_ID, $pos);
    if ($status)
      $this->Row = $pos;
    else {
      $this->halt("seek($pos) failed: result has ".$this->num_rows()." rows");

      /* half assed attempt to save the day, 
       * but do not consider this documented or even
       * desireable behaviour.
       */
      @mysql_data_seek($this->Query_ID, $this->num_rows());
      $this->Row = $this->num_rows;
      return 0;
    }

    return 1;
  }

  /* public: table locking */
  function lock($table, $mode="write") {
    $this->connect();
    
    $query="lock tables ";
    if (is_array($table)) {
      while (list($key,$value)=each($table)) {
        if ($key=="read" && $key!=0) {
          $query.="$value read, ";
        } else {
          $query.="$value $mode, ";
        }
      }
      $query=substr($query,0,-2);
    } else {
      $query.="$table $mode";
    }
    $res = @mysql_query($query, $this->Link_ID);
    if (!$res) {
      $this->halt("lock($table, $mode) failed.");
      return 0;
    }
    return $res;
  }
  
  function unlock() {
    $this->connect();

    $res = @mysql_query("unlock tables");
    if (!$res) {
      $this->halt("unlock() failed.");
      return 0;
    }
    return $res;
  }


  /* public: evaluate the result (size, width) */
  function affected_rows() {
    return @mysql_affected_rows($this->Link_ID);
  }

  function num_rows() {
    return @mysql_num_rows($this->Query_ID);
  }

  function num_fields() {
    return @mysql_num_fields($this->Query_ID);
  }

  /* public: shorthand notation */
  function nf() {
    return $this->num_rows();
  }

  function np() {
    print $this->num_rows();
  }

  function f($Name) {
    return $this->Record[$Name];
  }
  function ft($Name) {
  	global $lang;
	$url_lang=strtoupper($lang);
	if ($this->Record[$Name . "_" . $url_lang]!="") return $this->Record[$Name . "_" . $url_lang];
	if ($this->Record[$Name . "_FR"  ]!="") return $this->Record[$Name . "_FR"];	
	 return $this->Record[$Name];
  }
  function p($Name) {
    print $this->Record[$Name];
  }

  /* public: sequence numbers */
  function nextid($seq_name) {
    $this->connect();
    
    if ($this->lock($this->Seq_Table)) {
      /* get sequence number (locked) and increment */
      $q  = sprintf("select nextid from %s where seq_name = '%s'",
                $this->Seq_Table,
                $seq_name);
      $id  = @mysql_query($q, $this->Link_ID);
      $res = @mysql_fetch_array($id);
      
      /* No current value, make one */
      if (!is_array($res)) {
        $currentid = 0;
        $q = sprintf("insert into %s values('%s', %s)",
                 $this->Seq_Table,
                 $seq_name,
                 $currentid);
        $id = @mysql_query($q, $this->Link_ID);
      } else {
        $currentid = $res["nextid"];
      }
      $nextid = $currentid + 1;
      $q = sprintf("update %s set nextid = '%s' where seq_name = '%s'",
               $this->Seq_Table,
               $nextid,
               $seq_name);
      $id = @mysql_query($q, $this->Link_ID);
      $this->unlock();
    } else {
      $this->halt("cannot lock ".$this->Seq_Table." - has it been created?");
      return 0;
    }
    return $nextid;
  }

  /* public: return table metadata */
  function metadata($table='',$full=false) {
    $count = 0;
    $id    = 0;
    $res   = array();

    /*
     * Due to compatibility problems with Table we changed the behavior
     * of metadata();
     * depending on $full, metadata returns the following values:
     *
     * - full is false (default):
     * $result[]:
     *   [0]["table"]  table name
     *   [0]["name"]   field name
     *   [0]["type"]   field type
     *   [0]["len"]    field length
     *   [0]["flags"]  field flags
     *
     * - full is true
     * $result[]:
     *   ["num_fields"] number of metadata records
     *   [0]["table"]  table name
     *   [0]["name"]   field name
     *   [0]["type"]   field type
     *   [0]["len"]    field length
     *   [0]["flags"]  field flags
     *   ["meta"][field name]  index of field named "field name"
     *   The last one is used, if you have a field name, but no index.
     *   Test:  if (isset($result['meta']['myfield'])) { ...
     */

    // if no $table specified, assume that we are working with a query
    // result
    if ($table) {
      $this->connect();
      $id = @mysql_list_fields($this->Database, $table);
      if (!$id)
        $this->halt("Metadata query failed.");
    } else {
      $id = $this->Query_ID; 
      if (!$id)
        $this->halt("No query specified.");
    }
 
    $count = @mysql_num_fields($id);

    // made this IF due to performance (one if is faster than $count if's)
    if (!$full) {
      for ($i=0; $i<$count; $i++) {
        $res[$i]["table"] = @mysql_field_table ($id, $i);
        $res[$i]["name"]  = @mysql_field_name  ($id, $i);
        $res[$i]["type"]  = @mysql_field_type  ($id, $i);
        $res[$i]["len"]   = @mysql_field_len   ($id, $i);
        $res[$i]["flags"] = @mysql_field_flags ($id, $i);
      }
    } else { // full
      $res["num_fields"]= $count;
    
      for ($i=0; $i<$count; $i++) {
        $res[$i]["table"] = @mysql_field_table ($id, $i);
        $res[$i]["name"]  = @mysql_field_name  ($id, $i);
        $res[$i]["type"]  = @mysql_field_type  ($id, $i);
        $res[$i]["len"]   = @mysql_field_len   ($id, $i);
        $res[$i]["flags"] = @mysql_field_flags ($id, $i);
        $res["meta"][$res[$i]["name"]] = $i;
      }
    }
    
    // free the result only if we were called on a table
    if ($table) @mysql_free_result($id);
    return $res;
  }
  
  function xml_encode($text) {
    $search = array ("'&(quot|#34);'i", "'&(amp|#38);'i", "'&(lt|#60);'i", "'&(gt|#62);'i");
    $replace = array ( "\"", "&", "<", ">");
	//$text = iconv("ISO-8859-1","UTF-8",ereg_replace("&","&amp;",ereg_replace("< ","&lt; ",$text)));
    $text=preg_replace ($search, $replace, $text);
	return $text;
  }
  
 function get_xml($arr_element_names=array(), $specify_encoding=1, $specify_query=1)
  {
    $str = "";
	if (isset($arr_element_names["row"]))
		$row_element_name = $arr_element_names["row"];
	else
		$row_element_name = "row";
	if (isset($arr_element_names["resultset"]))
		$resultset_element_name = $arr_element_names["resultset"];
	else
		$resultset_element_name = "resultset";
	
	$arr_elements=array();
    if ($specify_encoding)
		$str = $str . '<?xml version="1.0" encoding="iso-8859-1"?>';

	//$this->Query_ID = @mysql_query($Query_String,$this->Link_ID);
	while ($row = @mysql_fetch_array($this->Query_ID, MYSQL_ASSOC)) 
	{
	if ($row_element_name !="") $this_element = "<$row_element_name>";
    while (list($key, $val) = each($row)) 
	{
	  $this_element .= '<' . $key . '>';
	  if (is_numeric($val) || trim($val)=="") 
	  	$this_element .= "$val";
	  else 				
	  	$this_element .= '<![CDATA[' . $this->xml_encode($val)  . ']]>';
	$this_element .= '</' . $key . '>';
    }
	if ($row_element_name !="") $this_element .= "</$row_element_name>";
	array_push($arr_elements,$this_element);
	//$str .= $this_element;
	}
	$all_elements = join("",$arr_elements);
	if ($specify_query)
		$query_attribute = 'query="' . $this->sql_query_string . '"';
	else
		$query_attribute = "";
    $str .= "<$resultset_element_name $query_attribute>" . $all_elements . "</$resultset_element_name>";
    return $str;
  }
  
  /* private: error handling */
  function halt($msg) {
    $this->Error = @mysql_error($this->Link_ID);
    $this->Errno = @mysql_errno($this->Link_ID);
    if ($this->Halt_On_Error == "no")
      return;

    $this->haltmsg($msg);

    if ($this->Halt_On_Error != "report")
      die("Session halted.");
  }

  function haltmsg($msg) {

   // printf("</td></tr></table><b>Database error:</b> %s<br>\n", $msg);
   // printf("<b>MySQL Error</b>: %s (%s)<br>\n",
     // $this->Errno,
     // $this->Error);
	 $included_files = get_included_files();

	//foreach ($included_files as $filename)   $str_included .= "[$filename ]";
	$str_included = array_pop($included_files);
	 
    add_notice_message(sprintf(" <b>MySQL Error %s </b>: %s (%s) on query %s in file %s", $msg, $this->Errno,      $this->Error ,  $this->sql_query_string, $str_included) );
  }

  function table_names() {
    $this->query("SHOW TABLES");
    $i=0;
    while ($info=mysql_fetch_row($this->Query_ID))
     {
      $return[$i]["table_name"]= $info[0];
      $return[$i]["tablespace_name"]=$this->Database;
      $return[$i]["database"]=$this->Database;
      $i++;
     }
   return $return;
  }
}
?>
