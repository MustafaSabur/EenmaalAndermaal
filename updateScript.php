<?php
 require ('connectserver.php');
$tsqlUpdate = "SELECT OBJECTNUMBER, ENDDATE, ENDTIME, AUCTION_CLOSED  FROM [OBJECT]";
$resultUpdate = sqlsrv_query( $conn, $tsqlUpdate, null);

if ( $resultUpdate === false)
{
die( print_r( sqlsrv_errors() ) );
}

//$i = 0;

while( $rowUpdate = sqlsrv_fetch_array( $resultUpdate, SQLSRV_FETCH_ASSOC)) {
	
	
			$datum = $rowUpdate['ENDDATE'];
			$datum = $datum->format('Y-m-d');
		
			$tijd = $rowUpdate['ENDTIME'];
			$tijd = $tijd->format('H:i:s');


			$tijdstamp = strtotime($datum." ".$tijd);
			$nu = strtotime(date('Y-m-d H:i:s'));
			$difference = $tijdstamp - $nu;
			
			if ($difference <= 0 && $rowUpdate['AUCTION_CLOSED'] == 0) { 
				$tsqlUpdate = "UPDATE [OBJECT]
				SET [AUCTION_CLOSED]='1'
				WHERE [OBJECTNUMBER]='$rowUpdate[OBJECTNUMBER]'";
				
				sqlsrv_query($conn, $tsqlUpdate, null);
				
				$tsqlUpdate2 = "SELECT TOP 1 [OBJECT].OBJECTNUMBER, [BID].BIDVALUE, [BID].USERNAME FROM [OBJECT] LEFT JOIN [BID] ON [OBJECT].OBJECTNUMBER = [BID].OBJECTNUMBER
								WHERE [AUCTION_CLOSED] = 'True' AND [BUYER] IS NULL AND [OBJECT].OBJECTNUMBER = '$rowUpdate[OBJECTNUMBER]' ORDER BY [BID].BIDVALUE DESC";

				$resultUpdate2 = sqlsrv_query( $conn, $tsqlUpdate2, null);
				$rowUpdate2 = sqlsrv_fetch_array( $resultUpdate2, SQLSRV_FETCH_ASSOC);
				
			if (!isset($rowUpdate2['BIDVALUE'])) {
				//NIKS
				echo 'niks';
			}
			
			else {
				$tsqlUpdate3 = "UPDATE [OBJECT]
								SET [BUYER] = '$rowUpdate2[USERNAME]'
								WHERE [OBJECTNUMBER] ='$rowUpdate[OBJECTNUMBER]'";
								$resultUpdate3 = sqlsrv_query( $conn, $tsqlUpdate3, null);
								echo 'wel';
			}
			
			} 
		//$i++;
		//echo $i;
		//echo ' ';
}
	

require ('closedb.php');
	?>	

		
		
	