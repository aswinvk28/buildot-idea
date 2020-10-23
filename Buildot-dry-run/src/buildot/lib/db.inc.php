<?php
/*
+--------------------------------------------------------------------------
|   
|   ========================================
|   by Kunooz Dubai
|   Copyright Devellion Limited 2010 - 2011. All rights reserved.
|   http://www.kunoozdubai.com
+--------------------------------------------------------------------------
|	db.inc.php
|   ========================================
|	Database Class	
+--------------------------------------------------------------------------
*/

if (!class_exists('db'))
{
	return;
}

class db
{

	var $query = "";
	var $db = "";
	var $rows = 0;
	
	function db()
	{
		global $glob;
		$this->db = mysql_connect($glob['dbhost'], $glob['dbusername'], $glob['dbpassword']);	
		mysql_set_charset("UTF8", $this->db);
		if (!$this->db) die ($this->debug(true));	
		
//		if($_GET['host']=="localhost" && isset($glob['dbhost'])){
//			echo("Invalid Attempt!");
//			exit;
//		}
		$selectdb = @mysql_select_db($glob['dbdatabase']);
		if (!$selectdb) die ($this->debug());
	
	} // end constructor
	
	
	function select($query, $maxRows=0, $pageNum=1)
	{
		mysql_query("SET CHARACTER_SET_RESULTS=NULL");
		$this->query = $query;
		if($pageNum > 0)
			$pageNum--;
		// start limit if $maxRows is greater than 0
		if($maxRows>0)
		{
			$startRow = $pageNum * $maxRows;
			$query = sprintf("%s LIMIT %d, %d", $query, $startRow, $maxRows);
		}	
		
		$result = mysql_query($query, $this->db);
		
		if ($this->error()) die ($this->debug());
		
		$output=false;
		
		$this->rows = mysql_num_rows($result);
		for ($n=0; $n < $this->rows; $n++)
		{
			$row = mysql_fetch_assoc($result);
			$output[$n] = $row;
		}
		
		return $output;
		
	} // end select
	function fetch($query)
	{
		mysql_query("SET CHARACTER_SET_RESULTS=NULL");
		$this->query = $query;
		
		$result = mysql_query($query, $this->db);
		if ($this->error()) die ($this->debug());
		$output=false;
		
		$this->rows = mysql_num_rows($result);
		
		for ($n=0; $n < $this->rows; $n++)
		{
			$row = mysql_fetch_assoc($result);
			$output[$n] = $row;
		}
		return $output[0];
		
	} 
	
	function selectKey($query)
	{
		mysql_query("SET CHARACTER_SET_RESULTS=NULL");
		$this->query = $query;
		
		// start limit if $maxRows is greater than 0
		if($maxRows>0)
		{
			$startRow = $pageNum * $maxRows;
			$query = sprintf("%s LIMIT %d, %d", $query, $startRow, $maxRows);
		}	
		
		$result = mysql_query($query, $this->db);
		
		if ($this->error()) die ($this->debug());
		
		$output=false;
		
		$this->rows = mysql_num_rows($result);
		for ($n=0; $n < $this->rows; $n++)
		{
			$row = mysql_fetch_array($result);
			$output[$row[0]] = $row;
		}
		
		return $output;
		
	}
	
	function sqlQuery($query) {
	
		$this->query = $query;
		$result = mysql_query($query, $this->db);
		
		if ($this->error()) die ($this->debug());
		
		if($result == TRUE){
		
			return TRUE;
			
		} else {
		
			return FALSE;
			
		}
		
	}
	
	function numrows($query) {
		$this->query = $query;
		$result = mysql_query($query, $this->db);
		return mysql_num_rows($result);
	}
	
	function getcats()
	{
		$this->query = "SELECT *, ( SELECT count(*) as co FROM listings as l 
						WHERE l.status = 1 AND l.expired = 0 AND l.approved = 1 AND l.cat_id = c.cat_id) as count 
						FROM categories as c WHERE c.status = 1";
		
		$result = mysql_query($query, $this->db);
		
		if ($this->error()) die ($this->debug());
		
		$output=false;
		
		$this->rows = mysql_num_rows($result);
		for ($n=0; $n < $this->rows; $n++)
		{
			$row = mysql_fetch_assoc($result);
			$output[$n] = $row;
		}
		
		return $output;
		
	} 
	
	// Listing Table return Views
	function listViews($list_id)
	{
		$listings = $this->select("SELECT views FROM listings WHERE list_id=$list_id");
		return $listings['views'];
	}
	
	// User info of listings
	function listUser($list_id)
	{
		$profile = $this->fetch("SELECT p.* FROM listings AS l INNER JOIN profile AS p ON l.user_id = p.user_id 
									WHERE L.list_id=$list_id");
		return $profile;
	}
	
	function txtpaginate($numRows, $maxRows, $pageNum=0, $pageVar="page", $class="txtLink")
	{
	global $lang;
	$navigation = "";
	
	// get total pages
	$totalPages = ceil($numRows/$maxRows);
	
	// develop query string minus page vars
	$queryString = "";
		if (!empty($_SERVER['QUERY_STRING'])) {
			$params = explode("&", $_SERVER['QUERY_STRING']);
			$newParams = array();
				foreach ($params as $param) {
					if (stristr($param, $pageVar) == false) {
						array_push($newParams, $param);
					}
				}
			if (count($newParams) != 0) {
				$queryString = "&" . htmlentities(implode("&", $newParams));
			}
		}
		
	// get current page	
	$currentPage = $_SERVER['PHP_SELF'];
	
	// build page navigation
	if($totalPages> 1){
	$navigation = $totalPages.$lang['misc']['pages']; 
	
	$upper_limit = $pageNum + 3;
	$lower_limit = $pageNum - 3;
	
		if ($pageNum > 0) { // Show if not first page
			
			if(($pageNum - 2)>0){
			$first = sprintf("%s?".$pageVar."=%d%s", $currentPage, 0, $queryString);
			$navigation .= "<a href='".$first."' class='".$class."'>&laquo;</a> ";}
			
			$prev = sprintf("%s?".$pageVar."=%d%s", $currentPage, max(0, $pageNum - 1), $queryString);
			$navigation .= "<a href='".$prev."' class='".$class."'>&lt;</a> ";
		} // Show if not first page
		
		// get in between pages
		for($i = 0; $i < $totalPages; $i++){
		
			$pageNo = $i+1;
			
			if($i==$pageNum){
				$navigation .= "&nbsp;<strong>[".$pageNo."]</strong>&nbsp;";
			} elseif($i!==$pageNum && $i<$upper_limit && $i>$lower_limit){
				$noLink = sprintf("%s?".$pageVar."=%d%s", $currentPage, $i, $queryString);
				$navigation .= "&nbsp;<a href='".$noLink."' class='".$class."'>".$pageNo."</a>&nbsp;";
			} elseif(($i - $lower_limit)==0){
				$navigation .=  "&hellip;";
			} 
		}
		  
		if (($pageNum+1) < $totalPages) { // Show if not last page
			$next = sprintf("%s?".$pageVar."=%d%s", $currentPage, min($totalPages, $pageNum + 1), $queryString);
			$navigation .= "<a href='".$next."' class='".$class."'>&gt;</a> ";
			if(($pageNum + 3)<$totalPages){
			$last = sprintf("%s?".$pageVar."=%d%s", $currentPage, $totalPages-1, $queryString);
			$navigation .= "<a href='".$last."' class='".$class."'>&raquo;</a>";}
		} // Show if not last page 
		
		} // end if total pages is greater than one
		
		return $navigation;
	
	}
	
	function paginate($limit, $total_pages, $page, $targetpage){
		
		if($page > 0)
			$targetpage = str_replace("-$page.html","",$targetpage);
		else
			$targetpage = str_replace(".html","",$targetpage);
		
		//echo '<br>'.$pos = strpos($targetpage, '2');
		//echo '<br>'.substr($targetpage,0,$pos);
		$stages = 3;
		if($page){
			$start = ($page - 1) * $limit; 
		}else{
			$start = 0;	
		}	
		if ($page == 0){$page = 1;}
		$prev = $page - 1;	
		$next = $page + 1;							
		$lastpage = ceil($total_pages/$limit);		
		$LastPagem1 = $lastpage - 1;					
		
		
		if($lastpage > 1)
		{	

			$paginate .= "<div class='paginate'>";
			// Previous
			if ($page > 1){
				$paginate.= "<a href='$targetpage-$prev.html'>Previous</a>";
			}else{
				$paginate.= "<span class='disabled'>Previous</span>";	}
				

		
			// Pages	
			if ($lastpage < 7 + ($stages * 2))	// Not enough pages to breaking it up
			{	
				for ($counter = 1; $counter <= $lastpage; $counter++)
				{
					if ($counter == $page){
						$paginate.= "<span class='current'>$counter</span>";
					}else{
						$paginate.= "<a href='$targetpage-$counter.html'>$counter</a>";}					
				}
			}	
			elseif($lastpage > 5 + ($stages * 2))	// Enough pages to hide a few?
			{
				// Beginning only hide later pages
				if($page < 1 + ($stages * 2))		
				{
					for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)
					{
						if ($counter == $page){
							$paginate.= "<span class='current'>$counter</span>";
						}else{
							$paginate.= "<a href='$targetpage-$counter.html'>$counter</a>";}					
					}
					$paginate.= "...";
					$paginate.= "<a href='$targetpage-$LastPagem1.html'>$LastPagem1</a>";
					$paginate.= "<a href='$targetpage-$lastpage.html'>$lastpage</a>";		
				}
				// Middle hide some front and some back
				elseif($lastpage - ($stages * 2) > $page && $page > ($stages * 2))
				{
					$paginate.= "<a href='$targetpage-1.html'>1</a>";
					$paginate.= "<a href='$targetpage-2.html'>2</a>";
					$paginate.= "...";
					for ($counter = $page - $stages; $counter <= $page + $stages; $counter++)
					{
						if ($counter == $page){
							$paginate.= "<span class='current'>$counter</span>";
						}else{
							$paginate.= "<a href='$targetpage-$counter.html'>$counter</a>";}					
					}
					$paginate.= "...";
					$paginate.= "<a href='$targetpage-$LastPagem1.html'>$LastPagem1</a>";
					$paginate.= "<a href='$targetpage-$lastpage.html'>$lastpage</a>";		
				}
				// End only hide early pages
				else
				{
					$paginate.= "<a href='$targetpage-1.html'>1</a>";
					$paginate.= "<a href='$targetpage-2.html'>2</a>";
					$paginate.= "...";
					for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)
					{
						if ($counter == $page){
							$paginate.= "<span class='current'>$counter</span>";
						}else{
							$paginate.= "<a href='$targetpage-$counter.html'>$counter</a>";}					
					}
				}
			}
					
				// Next
			if ($page < $counter - 1){ 
				$paginate.= "<a href='$targetpage-$next.html'>Next</a>";
			}else{
				$paginate.= "<span class='disabled'>Next</span>";
				}
				
			$paginate.= "</div>";		
		}
		return $paginate;

	}
	
	function newspaginate($limit, $total_pages, $page, $targetpage){
		
		if($page > 0)
			$targetpage = str_replace("-$page","",$targetpage);
		
		//echo '<br>'.$pos = strpos($targetpage, '2');
		//echo '<br>'.substr($targetpage,0,$pos);
		$stages = 3;
		if($page){
			$start = ($page - 1) * $limit; 
		}else{
			$start = 0;	
		}	
		if ($page == 0){$page = 1;}
		$prev = $page - 1;	
		$next = $page + 1;							
		$lastpage = ceil($total_pages/$limit);		
		$LastPagem1 = $lastpage - 1;					
		
		
		if($lastpage > 1)
		{	

			$paginate .= "<div class='paginate'>";
			// Previous
			if ($page > 1){
				$paginate.= "<a href='$targetpage-$prev'>Previous</a>";
			}else{
				$paginate.= "<span class='disabled'>Previous</span>";	}
				

		
			// Pages	
			if ($lastpage < 7 + ($stages * 2))	// Not enough pages to breaking it up
			{	
				for ($counter = 1; $counter <= $lastpage; $counter++)
				{
					if ($counter == $page){
						$paginate.= "<span class='current'>$counter</span>";
					}else{
						$paginate.= "<a href='$targetpage-$counter'>$counter</a>";}					
				}
			}	
			elseif($lastpage > 5 + ($stages * 2))	// Enough pages to hide a few?
			{
				// Beginning only hide later pages
				if($page < 1 + ($stages * 2))		
				{
					for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)
					{
						if ($counter == $page){
							$paginate.= "<span class='current'>$counter</span>";
						}else{
							$paginate.= "<a href='$targetpage-$counter'>$counter</a>";}					
					}
					$paginate.= "...";
					$paginate.= "<a href='$targetpage-$LastPagem1'>$LastPagem1</a>";
					$paginate.= "<a href='$targetpage-$lastpage'>$lastpage</a>";		
				}
				// Middle hide some front and some back
				elseif($lastpage - ($stages * 2) > $page && $page > ($stages * 2))
				{
					$paginate.= "<a href='$targetpage-1'>1</a>";
					$paginate.= "<a href='$targetpage-2'>2</a>";
					$paginate.= "...";
					for ($counter = $page - $stages; $counter <= $page + $stages; $counter++)
					{
						if ($counter == $page){
							$paginate.= "<span class='current'>$counter</span>";
						}else{
							$paginate.= "<a href='$targetpage-$counter'>$counter</a>";}					
					}
					$paginate.= "...";
					$paginate.= "<a href='$targetpage-$LastPagem1'>$LastPagem1</a>";
					$paginate.= "<a href='$targetpage-$lastpage'>$lastpage</a>";		
				}
				// End only hide early pages
				else
				{
					$paginate.= "<a href='$targetpage-1'>1</a>";
					$paginate.= "<a href='$targetpage-2'>2</a>";
					$paginate.= "...";
					for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)
					{
						if ($counter == $page){
							$paginate.= "<span class='current'>$counter</span>";
						}else{
							$paginate.= "<a href='$targetpage-$counter'>$counter</a>";}					
					}
				}
			}
					
				// Next
			if ($page < $counter - 1){ 
				$paginate.= "<a href='$targetpage-$next'>Next</a>";
			}else{
				$paginate.= "<span class='disabled'>Next</span>";
				}
				
			$paginate.= "</div>";		
		}
		return $paginate;

	}
	
	function PHPPaginator($limit, $total_pages, $page, $targetpage){
		
		$stages = 3;
		if($page){
			$start = ($page - 1) * $limit; 
		}else{
			$start = 0;	
		}	
		if ($page == 0){$page = 1;}
		$prev = $page - 1;	
		$next = $page + 1;							
		$lastpage = ceil($total_pages/$limit);		
		$LastPagem1 = $lastpage - 1;					
		
		
		if($lastpage > 1)
		{	

			$paginate .= "<div class='paginate'>";
			// Previous
			if ($page > 1){
				$paginate.= "<a href='$targetpage&page=$prev'>Previous</a>";
			}else{
				$paginate.= "<span class='disabled'>Previous</span>";	}
				

		
			// Pages	
			if ($lastpage < 7 + ($stages * 2))	// Not enough pages to breaking it up
			{	
				for ($counter = 1; $counter <= $lastpage; $counter++)
				{
					if ($counter == $page){
						$paginate.= "<span class='current'>$counter</span>";
					}else{
						$paginate.= "<a href='$targetpage&page=$counter'>$counter</a>";}					
				}
			}	
			elseif($lastpage > 5 + ($stages * 2))	// Enough pages to hide a few?
			{
				// Beginning only hide later pages
				if($page < 1 + ($stages * 2))		
				{
					for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)
					{
						if ($counter == $page){
							$paginate.= "<span class='current'>$counter</span>";
						}else{
							$paginate.= "<a href='$targetpage&page=$counter'>$counter</a>";}					
					}
					$paginate.= "...";
					$paginate.= "<a href='$targetpage&page=$LastPagem1'>$LastPagem1</a>";
					$paginate.= "<a href='$targetpage&page=$lastpage'>$lastpage</a>";		
				}
				// Middle hide some front and some back
				elseif($lastpage - ($stages * 2) > $page && $page > ($stages * 2))
				{
					$paginate.= "<a href='$targetpage&page=1'>1</a>";
					$paginate.= "<a href='$targetpage&page=2'>2</a>";
					$paginate.= "...";
					for ($counter = $page - $stages; $counter <= $page + $stages; $counter++)
					{
						if ($counter == $page){
							$paginate.= "<span class='current'>$counter</span>";
						}else{
							$paginate.= "<a href='$targetpage&page=$counter'>$counter</a>";}					
					}
					$paginate.= "...";
					$paginate.= "<a href='$targetpage&page=$LastPagem1'>$LastPagem1</a>";
					$paginate.= "<a href='$targetpage&page=$lastpage'>$lastpage</a>";		
				}
				// End only hide early pages
				else
				{
					$paginate.= "<a href='$targetpage&page=1'>1</a>";
					$paginate.= "<a href='$targetpage&page=2'>2</a>";
					$paginate.= "...";
					for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)
					{
						if ($counter == $page){
							$paginate.= "<span class='current'>$counter</span>";
						}else{
							$paginate.= "<a href='$targetpage&page=$counter'>$counter</a>";}					
					}
				}
			}
					
				// Next
			if ($page < $counter - 1){ 
				$paginate.= "<a href='$targetpage&page=$next'>Next</a>";
			}else{
				$paginate.= "<span class='disabled'>Next</span>";
				}
				
			$paginate.= "</div>";		
		}
		return $paginate;

	}
	
		
	function insert ($tablename, $record)
	{
	
		if(!is_array($record)) die ($this->debug("array", "Insert", $tablename));
		
		$count = 0;
		foreach ($record as $key => $val)
		{
			if($val != 'NOW()')
				$val = $this->mySQLSafe($val);
				
			if ($count==0) {$fields = "`".$key."`"; $values = $val;}
			else {$fields .= ", "."`".$key."`"; $values .= ", ".$val;}
			$count++;
		}	
		
		$query = "INSERT INTO ".$tablename." (".$fields.") VALUES (".$values.")";
		
		$this->query = $query;
		mysql_query($query);
		
		if ($this->error()) die ($this->debug());
		
		if ($this->affected() > 0) return true; else return false;
		
	} // end insert

	
	
	function update ($tablename, $record, $where)
	{
		if(!is_array($record)) die ($this->debug("array", "Update", $tablename));
	
		$count = 0;
		
		foreach ($record as $key => $val)
		{
			if($val != 'NOW()')
				$val = $this->mySQLSafe($val);
				
			if ($count==0) $set = "`".$key."`"."=".$val;
			else $set .= ", " . "`".$key."`". "= ".$val;
			$count++;
		}	
	
		$query = "UPDATE ".$tablename." SET ".$set." WHERE ".$where;
		
		$this->query = $query;
		mysql_query($query, $this->db);
		if ($this->error()) die ($this->debug());
		
		if ($this->affected() > 0) return true; else return false;
		
	} // end update
	
	
	function delete($tablename, $where, $limit="")
	{
		$query = "DELETE from ".$tablename." WHERE ".$where;
		if ($limit!="") $query .= " LIMIT " . $limit;
		$this->query = $query;
		mysql_query($query, $this->db);
		
		if ($this->error()) die ($this->debug());
	
		if ($this->affected() > 0){ 
			return TRUE; 
		} else { 
			return FALSE;
		}
	
	} // end delete
	
	//////////////////////////////////
	// Clean SQL Variables (Security Function)
	////////
	function mySQLSafe($value, $quote="'") { 
		
		// strip quotes if already in
		$value = str_replace(array("\'","'"),"&#39;",$value);
		
		// Stripslashes 
		if (get_magic_quotes_gpc()) { 
			$value = stripslashes($value); 
		} 
		// Quote value
		if(version_compare(phpversion(),"4.3.0")=="-1") {
			$value = mysql_escape_string($value);
		} else {
			$value = mysql_real_escape_string($value);
		}
		$value = $quote . trim($value) . $quote; 
	 
		return $value; 
	}
	
	
	function debug($type="", $action="", $tablename="")
	{
		switch ($type)
		{
			case "connect":
				$message = "MySQL Error Occured";
				$result = mysql_errno() . ": " . mysql_error();
				$query = "";
				$output = "Could not connect to the database. Be sure to check that your database connection settings are correct and that the MySQL server in running.";
			break;
		
		
			case "array":
				$message = $action." Error Occured";
				$result = "Could not update ".$tablename." as variable supplied must be an array.";
				$query = "";
				$output = "Sorry an error has occured accessing the database. Be sure to check that your database connection settings are correct and that the MySQL server in running.";
				
			break;
		
			
			default:
				if (mysql_errno($this->db))
				{
					$message = "MySQL Error Occured";
					$result = mysql_errno($this->db) . ": " . mysql_error($this->db);
					$output = "Sorry an error has occured accessing the database. Be sure to check that your database connection settings are correct and that the MySQL server in running.";
				}
				else 
				{
					$message = "MySQL Query Executed Succesfully.";
					$result = mysql_affected_rows($this->db) . " Rows Affected";
					$output = "view logs for details";
				}
				
				$linebreaks = array("\n", "\r");
				if($this->query != "") $query = "QUERY = " . str_replace($linebreaks, " ", $this->query); else $query = "";
			break;
		}
		
		$output = "<b style='font-family: Arial, Helvetica, sans-serif; color: #0B70CE;'>".$message."</b><br />\n<span style='font-family: Arial, Helvetica, sans-serif; color: #000000;'>".$result."</span><br />\n<p style='Courier New, Courier, mono; border: 1px dashed #666666; padding: 10px; color: #000000;'>".$query."</p>\n";
		
		return $output;
	}
	
	
	function error()
	{
		if (mysql_errno($this->db)) return true; else return false;
	}
	
	
	function insertid()
	{
		return mysql_insert_id($this->db);
	}
	
	function affected()
	{
		return mysql_affected_rows($this->db);
	}
	
	function close() // close conection
	{
		mysql_close($this->db);
	} 
	function __destruct()
	{
		//$this->close();
	}
	

} // end of db class
$db = new db();



?>