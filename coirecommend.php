<?php 
	//include('connect.php');
	//require('session.php');
//  echo "abc"; exit;
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Community Recommendation</title>
  <script type="text/javascript">
 
  </script>
  <link rel="stylesheet" type="text/css" href="recommend.css">
</head>
<?php
 		  $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "db";

         // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
     // Check connection
     if ($conn->connect_error)
     {
         die("Connection failed: " . $conn->connect_error);
     }
     $conn1 = new mysqli($servername, $username, $password, $dbname);
     // Check connection
     if ($conn1->connect_error)
     {
         die("Connection failed: " . $conn1->connect_error);
     }
	 ?>


<style type="text/css">

</style>
<body>
<div class="top">
	<hr/>
	
		<h1 align="center"><font color="#f0b52b" style="left:43%; top:7%; position:absolute;">Recommendated Communities </font></h1>
    <a href="newprofile.php" class="previous">Back to Home</a>
  
  <a class="next" href="  index.php">Logout</a>

  </div>
  <ul>
  <li><b><a href="userrecommend.php">User Recommendation</a></b></li>
  <li><b><a href="socialrecommend.php">Social Recommendation</a></b></li>
  <li><b><a href="coirecommend.php">Community Recommendation</a></b></li>
  
</ul>
  <?php

  $uid=$_SESSION['SESS_MEMBER_ID'];

   $sql_1="SELECT Community FROM `coi_new` WHERE `member_id`=$uid";
  $result1=mysqli_query($conn1,$sql_1);
  echo "<br>";
  if($result1)
$row1=mysqli_fetch_assoc($result1);
 
//   $coi_arr=explode(',', $row1['Community']);
  
// print_r($coi_arr);
//   //{
  
    echo "<br>";
   //echo $sql_3="SELECT Community FROM social_new WHERE social_id!=$uid AND social_id!=1 AND (Community!= '".$coi_arr."'')";
     # code...
  //echo $sql_2="SELECT DISTINCT(Community) FROM `social_new` WHERE `social_id`!=$uid AND `social_id`!=1 AND `Community` NOT IN('".$key1."') ";
    $sql_2="SELECT * FROM `list_coi` WHERE Communities NOT IN (SELECT `Community` FROM `coi_new`WHERE member_id=$uid)";
    $result2=mysqli_query($conn1,$sql_2);

    ?>
    <table width="60%" border="1" align="center">
      <col width=40%>
      <col width=20%>
      	<!-- <tr>
      		<th colspan="2" align="center"><font size="+3" color="#de423a"><b>Recommendated Communities</b></font></th>
      		
      	</tr> -->
      	<?php
        if($result2)
           while ($row2=mysqli_fetch_assoc($result2)) 
    {

      // echo "<br>";
          //echo $row2['Community'];
    ?>
      	<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row2['Communities']?></td>
      	<td><a href="updatecoi.php" >Join Community</a>
         <!--button>Join Community</button-->
        </td></tr>
        
<?php
//print_r($b=explode(",",$row2['Community']));
}
?>

<!---code for comparision of two communities-->
<?php


?>
</table>

</body>
</html>
<?php
$select="SELECT * FROM coi_new WHERE member_id=$uid";
$run=mysqli_query($conn1, $select);
$row=mysqli_fetch_assoc($run);echo"<br>";
$coi_arr=explode(",",$row['Community']);
echo $no=mysqli_num_rows($run);
//print_r($coi_arr);
$n=0;
echo"<br>";
for ($i=0; $i < sizeof($coi_arr) ; $i++)
{
$select1="SELECT * FROM coi_new WHERE member_id!=$uid AND member_id!=1 AND Community LIKE '%$coi_arr[$i]%' ";

echo "<br>";
$run1=mysqli_query($conn1,$select1) or die( mysqli_error($conn1));

if($run1)
{
  //echo "query";

 while($row1=mysqli_fetch_assoc($run1))
  {
    
   $coi_arr1=explode(',', $row1['Community']);
    echo"<br>"; 
   if(substr_count($row1['Community'],$coi_arr[$i]))
      { 
        
        
          $rec2=0.10*1;
          echo"<br>";
          //echo $rec2;
      }
      else 
      {
        $rec2=0;
      echo"<br>";
         //echo $rec2;
      } 
    
      
      $n=$n+$rec2;
      $coivalue=$n;

  }

}
}
echo "coirecommendation is = =";
echo number_format((float)$coivalue, 2, '.', ''); 
echo "<br>";
$_SESSION['coi_value']=$coivalue;
?>
<?php
$id= $_SESSION['SESS_MEMBER_ID'];
 $userval=$_SESSION['user_value'];
  //echo"user recommendation is".$userval;
   $socialval=$_SESSION['social_value'];
  //echo"social recommendation is".$socialval;

$total=($userval+$coivalue+$socialval)/3;
//echo "Total is".$total;

$sql="SELECT * FROM indirect WHERE member_id=$id";
$qry=mysqli_query($conn1,$sql);
if (mysqli_num_rows($qry)==0) {

  $insert=" INSERT INTO indirect(member_id,user,social,coi,total) VALUES ('$id','$userval','$socialval','$coivalue','$total') ";
}
else
{
    $insert="UPDATE indirect SET user='$userval',social='$socialval',coi='$coivalue',total='$total' WHERE member_id=$id";
}

   $run=mysqli_query($conn1,$insert);
   

      ?>