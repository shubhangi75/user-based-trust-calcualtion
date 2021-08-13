<?php
	//require('session.php');
  //include ('recommendcal.php');
  //include ('connect.php');
  session_start();
 //echo "abc"; exit;
?>
<html>
<head>
<title>User Recomme Page</title>
<style type="text/css">



/* Change the link color on hover */
li a:hover {
  background-color: #555;
  color: white;
}
</style>

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

<body >


<div class="top">
<hr/>
<h1 align="center"><font color="#FFFFFF" style="left:43%; top:5%; position:absolute;">Recommendated User </font></h1>

 
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
 
  $sql1="SELECT * FROM `member` WHERE `member`.`member_id`=$uid";
  $result1=mysqli_query($conn1,$sql1);
  $row1=mysqli_fetch_assoc($result1);
  $hobbies_arr=explode(',', $row1['hobbies']);
echo "<br>";
//print_r($hobbies_arr);

echo "<br>";
    $sql2="SELECT * FROM `member` WHERE `member`.`member_id` NOT IN (SELECT `friends_with` FROM `friends` WHERE `member_id`=$uid)AND `member`.`member_id`!=$uid and `member`.`member_id`!= 1 and  (`member`.`interest` = '".$row1['interest']."' OR `member`.`hobbies` = '".$row1['hobbies']."' ) ORDER BY `member_id` ASC";
  //echo $sql2;
  echo "<br>";
  $result2=mysqli_query($conn1,$sql2) or die( mysqli_error($conn1));
  if($result2)
  {
    
  ?>
  <div class="rightside">
    <!--marquee style='color:RED;'><h2> Recommendation based on Gender,Community of Interest, Interest</h2></marquee-->
    <br><br>
    <table>
      <tr><th height="50px"><b><font size="+2">Profile Pic</b></font></th>
          <th><b><font size="+2">Member Name</font></b></th>
          <th width="100px;"><b><font size="+2">&nbsp</font></b></th>
          <!--th width="100px;"><b><font size="+2">Interest</font></b></th>
          <th width="100px;"><b><font size="+2">Hobbies</font></b></th--></tr>
  <?php  $rec1=0;$rec2=0;$rec3=0;
  $num = mysqli_num_rows($result2);
 $n1=0;
 
  while($row2=mysqli_fetch_assoc($result2))
  {
    
  //echo "<br>".$row2['member_id']."<br>";
    $hobbies_arr1=explode(',', $row2['hobbies']);
    $a1=in_array($hobbies_arr1, $hobbies_arr);
    //print_r($a1);
    
    // foreach ($a1 as $key ) {
    //   $newvar=$key;
    //   # code...
    // }
    for ($i=0; $i < sizeof($hobbies_arr) ; $i++)
    {   
         if(in_array($hobbies_arr[$i],$hobbies_arr1))
      { 
        
        
          $rec2=0.30*1;
          // echo"<br>";
          // echo $rec2;
      }
      else{
        $rec2=0.30*0;
      // echo"<br>";
      //     echo $rec2;
      } 
    }

    if(strcmp($row1['interest'],$row2['interest'])==0 && $row2['interest'] != '')
    {
      $rec3=0.30*1;
      //echo "3";
    }
     else{
        $rec3=0.35*0;
      }

?>

            <tr>
              <td align="center">
                <div  style="text-align:center; width:50px; box-shadow: 5px 5px 5px grey;border-style: solid 50px;padding: 2px 2px 2px 2px;">
                  <img src="<?php echo $row2['profImage']; ?>" height='50px' width='50px'>
                </div>
              </td>
              <td>
                &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row2['FirstName']." ".$row2['LastName'] ?>
              </td>
              <td align="center">
                <a href="addfriend.php?id=<?php echo $row2['member_id']?>"> Add as friend</a>
              </td>
              <!--td>
                &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row2['interest']?>
              </td>
               <td>
                &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row2['hobbies']?>
              </td--->
            </tr>

         


      <?php
    //}
      $RecomendValue=  $rec2 + $rec3;
      $n1=$n1+$RecomendValue;
  
  }
  //echo "<br";
  
//echo $n1;
//echo "<br>". $avg = $n1/$num."<br>";
  $avg = $n1/$num;
$_SESSION['user_value']=$avg;

  //echo "uesr=".$_SESSION['user_value'];
}
    //

  
   
  ?>
    </table>
  </div>


</body>
</html>

<?php
//Accuracy calculation
//echo "TP is=".$num."<br>";
$tp=$num; //$num is the total no. of rows from user recommend

 $fn_query="SELECT * FROM member WHERE `member`.`member_id` NOT IN (SELECT `friends_with` FROM `friends` WHERE `member_id`=$uid)AND `member`.`member_id`!=$uid and `member`.`member_id`!= 1 and  (`member`.`interest` != '".$row1['interest']."' AND `member`.`hobbies`!= '".$row1['hobbies']."' ) ORDER BY `member_id` ASC";
$fn_run=mysqli_query($conn1,$fn_query);
$fn=mysqli_num_rows($fn_run);
//echo "FN is".$fn;

$tn_qry="SELECT * FROM `member` WHERE `member`.`member_id` NOT IN (SELECT `friends_with` FROM `friends` WHERE `member_id`=$uid)AND `member`.`member_id`!=$uid and `member`.`member_id`!= 1 and `member`.`Gender`!= '".$row1['Gender']."'AND (`member`.`interest` != '".$row1['interest']."' OR `member`.`hobbies`!= '".$row1['hobbies']."') ORDER BY `member_id` ASC";
$tn_run=mysqli_query($conn1,$tn_qry);
$tn=mysqli_num_rows($tn_run);
//echo "TN is=".$tn;

$fp_qry="SELECT * FROM `member` WHERE `member`.`member_id` NOT IN (SELECT `friends_with` FROM `friends` WHERE `member_id`=$uid)AND `member`.`member_id`!=$uid and `member`.`member_id`!= 1 and (`member`.`Gender`= '".$row1['Gender']."'OR `member`.`interest` = '".$row1['interest']."') AND `member`.`hobbies`!= '".$row1['hobbies']."' ORDER BY `member_id` ASC";
$fp_run=mysqli_query($conn1,$fp_qry);
$fp=mysqli_num_rows($fp_run);
//echo "FP is=".$fp;

$p=$tp/($tp+$fp);
$pre=number_format($p,2);

//echo "Precision is".$pre."<br>";

$r=number_format(($tp/($tp+$fn)),2);
//echo "Recall is".$r;

$a=number_format((($tp+$tn)/($tp+$tn+$fp+$fn)),2);


$sel="SELECT * FROM accuracy WHERE member_id=$uid";
$exe=mysqli_query($conn1,$sel);
if(mysqli_num_rows($exe)<=0)
{
  $insert="INSERT INTO accuracy (member_id,TP,TN,FP,FN,pre,Recall,Accuracy) VALUES ('$uid','$tp','$tn','$fp','$fn','$pre','$r','$a')";
}
else {
    $insert="UPDATE accuracy SET TP='$tp',TN='$tn',FP='$fp',FN='$fn',pre='$pre',Recall='$r',Accuracy='$a'WHERE member_id='$uid'";
  }  
$run_in=mysqli_query($conn1,$insert);

/* calculation for 50% data*/
/*true postive*/
$sql_5="SELECT * FROM `member` WHERE `member`.`member_id` NOT IN (SELECT `friends_with` FROM `friends` WHERE `member_id`=$uid)AND `member`.`member_id`!=$uid and `member`.`member_id`!= 1 and  (`member`.`interest` = '".$row1['interest']."' OR `member`.`hobbies` = '".$row1['hobbies']."' ) ORDER BY `member_id` LIMIT 50";
$result_5=mysqli_query($conn1,$sql_5) or die( mysqli_error($conn1));
$tp_5=mysqli_num_rows($result_5);

/*false negative*/
 $f_5="SELECT * FROM member WHERE `member`.`member_id` NOT IN (SELECT `friends_with` FROM `friends` WHERE `member_id`=$uid)AND `member`.`member_id`!=$uid and `member`.`member_id`!= 1 and  (`member`.`interest` != '".$row1['interest']."' OR `member`.`hobbies`!= '".$row1['hobbies']."' ) ORDER BY `member_id` LIMIT 50";
$f_run=mysqli_query($conn1,$f_5);
$fn_5=mysqli_num_rows($f_run);

/*true -ve*/
$t_5qry="SELECT * FROM `member` WHERE `member`.`member_id` NOT IN (SELECT `friends_with` FROM `friends` WHERE `member_id`=$uid)AND `member`.`member_id`!=$uid and `member`.`member_id`!= 1 and `member`.`Gender`!= '".$row1['Gender']."'AND(`member`.`interest` != '".$row1['interest']."' OR `member`.`hobbies`!= '".$row1['hobbies']."') ORDER BY `member_id` LIMIT 50";
$t_run=mysqli_query($conn1,$t_5qry);
$tn_5=mysqli_num_rows($t_run);

/*fasle +ve*/
$fp_5qry="SELECT * FROM `member` WHERE `member`.`member_id` NOT IN (SELECT `friends_with` FROM `friends` WHERE `member_id`=$uid)AND `member`.`member_id`!=$uid and `member`.`member_id`!= 1 and `member`.`Gender`= '".$row1['Gender']."'AND(`member`.`interest` != '".$row1['interest']."' OR `member`.`hobbies`!= '".$row1['hobbies']."') ORDER BY `member_id` LIMIT 50";
$fp_run5=mysqli_query($conn1,$fp_5qry);
$fp5=mysqli_num_rows($fp_run5);

$p5=$tp_5/($tp_5+$fp5);
$pre5=number_format($p5,2);

$r5=number_format(($tp_5/($tp_5+$fn_5)),2);
$a_5=number_format((($tp_5+$tn_5)/($tp_5+$tn_5+$fp5+$fn_5)),2);

$sele="SELECT * FROM fifty_acc WHERE member_id=$uid";
$exe_1=mysqli_query($conn1,$sele);
if(mysqli_num_rows($exe_1)<=0)
{

  $insert5="INSERT INTO fifty_acc (member_id,pre,recall,accuracy) VALUES ('$uid','$pre5','$r5','$a_5')";
}
else{
  $insert5="UPDATE fifty_acc SET pre='$pre',Recall='$r',Accuracy='$a' WHERE member_id='$uid'";
}
$run_5=mysqli_query($conn1,$insert5);
?>
<?php include('accuracy.php');?>