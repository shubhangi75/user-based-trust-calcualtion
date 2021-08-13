
<html>
<head>
		<style>
			#customers {
			    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
			    border-collapse: collapse;
			    width: 95%;
			}

			#customers td, #customers th {
			    border: 1px solid #bbb;
			    padding: 8px;
			}

			#customers tr:nth-child(even){background-color: #e9c4fc;}

			#customers tr:hover {background-color: #ddd;}

			#customers th {
			    padding-top: 12px;
			    padding-bottom: 12px;
			    text-align: left;
			    background-color: #5996ff;
			    color: Black;
			}
		</style>
	</head>

<body bgcolor="#FFFFCC">
<div style="background-color:#4475c9; background-image: linear-gradient(#4475c9,#042b6e 100%); height:18%; width:100%">
<hr/>
<h2><font color="#FFFFFF" style="left:43%; top:9%; position:absolute; font-size:32px;"><b>Login Statistics</b></font></h2>

</div>
 <table width="100%">
 <tr>
 <td width="50%">
<a href="adminhome.php" name="something">Back to Home Page |</a> 
</td>
<td align="right">
<a href="index.php" name="something"> Logout </a>
</td>
</tr>
</table>
<hr />


<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db";
//--------------------------------------------------------------
$SERVERIP2=array();
$fuzzywt2=array();

$conn2 = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn2->connect_error) {
    die("Connection failed: " . $conn2->connect_error);
} 

$sql2 = "SELECT SERVERIP,fuzzywt FROM `server`";
$result2 = $conn2->query($sql2);

if ($result2->num_rows > 0) {
    // output data of each row
	
    while($row2 = $result2->fetch_assoc()) {
       
	    $SERVERIP2[]=$row2['SERVERIP']; 
        $fuzzywt2[]=$row2['fuzzywt']; 
	  
    }
	
	
} else {
    echo "0 results";
}


//-----
	$s=0;
	while($s<sizeof($SERVERIP2))
	{
	 // echo $SERVERIP2[$s]."----";
	 
	  $sql5 = "UPDATE `db`.`member` SET `devicetrust` = '$fuzzywt2[$s]' WHERE `member`.`ipid` = '$SERVERIP2[$s]'";
	  mysql_select_db('test_db');
	  
	  if ($conn2->query($sql5) === TRUE) {
              echo "";
		} else {
			//echo "Error: " . $sql5 . "<br>" . $conn2->error;
		}
	   
	  $s++;
	}
	//-----

  



$conn2->close();

//---------------------------------------------------------------
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

 $sql="SELECT m.member_id,m.UserName,m.ipid,m.Url,m.curcity,m.community_of_int,m.devicetrust, t.TrustValue FROM member m INNER JOIN trust_table t ON m.member_id=t.member_id";
    $result=mysqli_query($conn,$sql);
 $storeArray = Array();
 // $storeArray = Array();
  
  echo "<table border='1' calspacing=10 align='center' id='customers'>
     <tr><th>User Name</th>
	 <th>IP Address</th>
	 <th>Email id</th>
	 <th>Community</th>
	 <th>City</th>
	 <th>Trust Values</th>
	 <th>Device Trust Values</th>
	 <th>User Status</th>
	  <tr>";
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $storeArray[] =  $row['ipid'];     
	$storeArray[] =  $row['UserName']; 
	$storeArray[] =  $row['Url'];
	$storeArray[] =  $row['community_of_int']; 
	$storeArray[] =  $row['curcity'];
	$storeArray[] =  $row['TrustValue']; 
	$storeArray[] =  $row['devicetrust']; 
    if($row['ipid']=='' && $row['UserName']=='' && $row['Url']=='' && $row['curcity']=='' && $row['TrustValue']=='')
    {}
    else
    {
        
         echo " <tr><td>$row[UserName]</td><td>$row[ipid]</td><td>$row[Url]</td><td>$row[community_of_int]</td><td>$row[curcity]</td><td>$row[TrustValue]</td><td>$row[devicetrust]</td>";
		
		if($row['TrustValue'] >= 0.5 && $row['devicetrust'] >=15 )
		{
			echo "<td style='background-color: #c9fccf;'><font color='Green'>Trusted User</font></td></tr>";
		}
		else
		{
			echo "<td style='background-color: #ffbcbc;'><font color='Red'>Not Trusted User</font></td></tr>";
		}
		
		
    }

}
echo "</table>";
mysqli_close($conn);

?>

</body>
</html>
