<?php
	
	$connection  = mysql_connect('localhost', 'nanapet_user', '-#cLp.SMaa0J');

	if (!$connection ) 
	{
    	echo('Could not connect ');
	}
	
	$db = "nanapet_db";
	
	if ($db != '' && !mysql_select_db( $db, $connection)) 
	{
		echo('Die Database ');
	}
				
	$sql = "SELECT * FROM scores";
	
	$cursor = mysql_query($sql, $connection);	
		
	if(!$cursor)
	{
		echo("Query Table Scores error");
	}
	
	else
	{										
		while ($row = mysql_fetch_assoc( $cursor )) 
		{
			$array[] = $row;
		}
								
		mysql_free_result( $cursor );		
				
		$sqlVIPCustomer = "SELECT * FROM VIPCustomer ORDER BY Score DESC";	

		$cursorVIPCustomer = mysql_query($sqlVIPCustomer, $connection);	

		if(!$cursorVIPCustomer)
		{
			echo("Query Table VIPCustomer error");
		}
		
		else								
		{
			while ($rowVIPCustomer = mysql_fetch_assoc( $cursorVIPCustomer )) 
			{
				$arrayVIPCustomer[] = $rowVIPCustomer;
			}
	
			mysql_free_result( $cursorVIPCustomer );
		}																		
		
		if(count ($arrayVIPCustomer) > 0 && count($array) > 0)
		{		
			for( $i = 0; $i < count($array) ; $i++ )
			{											
				$lag = 0;
											
				$j = 0;
				
				while ($j < count($arrayVIPCustomer)):			    				
							
					if($lag == 0)
					{
						if($array[$i]['score'] == "")
	
							$array[$i]['score'] = 0;
							
						if($array[$i]['scorelevel'] == "")	
	
							$array[$i]['scorelevel'] = 0;
							
						if(( $array[$i]['score'] + $array[$i]['scorelevel'] ) >= $arrayVIPCustomer[$j]['Score'] && $array[$i]['fee4Ever'] == $arrayVIPCustomer[$j]['FeeLevel'])
						{
							$lag = 1;
							
							$sql = "";
		
							$sql .= " UPDATE scores SET honors = '". $arrayVIPCustomer[$j]['NameVIPCustomer'] . "' WHERE id = " .$array[$i]['id']. " ;";
							$cursor = mysql_query($sql, $connection);
		
							if(!$cursor)
							{				
								echo(" Update honors error at id = ") . $array[$i]['id'] . " ; " ;
							}
		
							mysql_free_result($cursor);
													
							
							$sql = "";						
							
							$sql .= " UPDATE scores SET scorelevel =  " .$arrayVIPCustomer[$j]['Score']. " WHERE id = " .$array[$i]['id']. " ;";												
							
							$cursor = mysql_query($sql, $connection);
							
							if(!$cursor)
							{				
								echo(" Update scorelevel error at id = ") . $array[$i]['id'] . " ; " ;
							}
		
							mysql_free_result( $cursor );		
							
														
							$sql = "";
							
							$newScore	=  ($array[$i]['score'] + $array[$i]['scorelevel'])  - $arrayVIPCustomer[$j]['Score'];
							
							$sql .= " UPDATE scores SET score =  " .$newScore. " WHERE id = " .$array[$i]['id']. " ;";												
							
							$cursor = mysql_query($sql, $connection);
							
							if(!$cursor)
							{				
								echo(" Update score error at id = ") . $array[$i]['id'] . " ; " ;
							}
		
							mysql_free_result( $cursor );												
							
						}
					}	
				
				$j++;
							
				endwhile;																																									
			}											
		}
	}		
	
	echo("Update Finish!");
	
	mysql_close($connection);	
						
?>