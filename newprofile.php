<?php
	require('session.php');
	echo"";
?>
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
<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript">
<!--
var timeout         = 500;
var closetimer		= 0;
var ddmenuitem      = 0;

// open hidden layer
function mopen(id)
{	
	// cancel close timer
	mcancelclosetime();

	// close old layer
	if(ddmenuitem) ddmenuitem.style.visibility = 'hidden';

	// get new layer and show it
	ddmenuitem = document.getElementById(id);
	ddmenuitem.style.visibility = 'visible';

}
// close showed layer
function mclose()
{
	if(ddmenuitem) ddmenuitem.style.visibility = 'hidden';
}

// go close timer
function mclosetime()
{
	closetimer = window.setTimeout(mclose, timeout);
}

// cancel close timer
function mcancelclosetime()
{
	if(closetimer)
	{
		window.clearTimeout(closetimer);
		closetimer = null;
	}
}

// close layer when click-out
document.onclick = mclose; 
// -->
</script>
	<title>Profile</title>
</head>
<link href="newprofile.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="icon" href="img/icon.png" type="image" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="./js/jquery-1.4.2.min.js"></script>
<link href="facebox1.2/src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<link href="../css/example.css" media="screen" rel="stylesheet" type="text/css" />
 <link href="facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="facebox1.2/src/facebox.js" type="text/javascript"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript">

jQuery(document).ready(function($) {
  $('a[rel*=facebox]').facebox() 
  	closeImage   : "img/closelabel.png" 
})
</script>
<script>
		!window.jQuery && document.write('<script src="jquery-1.4.3.min.js"><\/script>');
	</script>
	<script type="text/javascript" src="./fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="./fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="./fancybox/jquery.fancybox-1.3.4.css" media="screen" />
 	<!--link rel="stylesheet" href="style.css" /-->
	<script type="text/javascript">
		$(document).ready(function() {
			

			$("a[rel=example_group]").fancybox({
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'titlePosition' 	: 'over',
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
					return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
				}
			});

			
		});
	</script>
		<script type="text/javascript">

$(document).ready(function(){
$("#shadow").fadeOut();

	$("#cancel_hide").click(function(){
        $("#").fadeOut("slow");
        $("#shadow").fadeOut();
		
   });
      });
   </script>
<!--script for dropdown list-->
   <script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(e) {
  if (!e.target.matches('.dropbtn')) {
  var myDropdown = document.getElementById("myDropdown");
    if (myDropdown.classList.contains('show')) {
      myDropdown.classList.remove('show');
    }
  }
}
</script>

<style type="text/css">
	


</style>

<body>
	<div class="topnav" id="myTopnav">
  <a href="newprofile.php" class="active">Profile</a>
  <a href="editprofile.php">Edit Profile</a>
  <a href="menu.php">About Me</a>
   <a href="index.php">Logout</a> 
  <a href="wall.php" style="text-align: right;margin-left: 400px;" ><?php
		$result = mysqli_query($conn1,"SELECT * FROM member WHERE member_id='".$_SESSION['SESS_MEMBER_ID'] ."'");
		while($row = mysqli_fetch_array($result))
		  {
		  echo "<img width=20 height=15 alt='Unable to View' src='" . $row["profImage"] . "'>";
			echo"  ";
		  echo $row["FirstName"];
		  echo"  ";
		  echo $row["LastName"];
		  }

?></a>                     
  
  <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
  <div class="search-container">
    <form action="/action_page.php">
      <input type="text" placeholder="Search.." name="search">
      <button type="submit"><i class="fa fa-search"></i></button>
    </form>
  </div>
</div>

	<!-- <div class="container">
	<div class="topnav toppane">
		<div class="searchbox">
		<form class="example" action="/action_page.php" style="max-width:300px;">
  <input type="text" placeholder="Search.." name="search2">
  <button type="submit"><i class="fa fa-search"></i></button>
</form> </div>

		<div class="topnav-right">
		  <a class="active" href="newprofile.php">Profile</a>
		  <a href="editprofile.php">Edit Profile</a>
		  <a href="#" onMouseOver="mopen('m5')">Account</a>
		  <a href="menu.php">About Me </a>
		  <a href="index.php">Logout </a>
		</div>  
</div> -->

  <!--div class="toppane">Test Page</div-->
  <div class="leftpane">
    <div class="text-center">    	
	<?php
include('connect.php');
$id= $_SESSION['SESS_MEMBER_ID'];	
$image=mysql_query("SELECT * FROM member WHERE member_id='$id'");
			$row=mysql_fetch_assoc($image);
			$_SESSION['image']= $row['profImage'];
			$usr_community=$row['community_of_int'];
			echo '<div id="pic" >';
			echo '<a href='.$row['profImage'].' rel=facebox;><img style="box-shadow: 5px 5px 5px #8053e0; margin-left:15px;margin-top:10px;" width=140 height=140 alt="Unable to View" src="' . $_SESSION['image'] . '"></a>';
			echo '</div>';

?>
</div>
<br>
<ul class="list-group" >
	<li class="list-group-item text-muted"><a href="editpic.php"><img src="img/pencil.png" width="17" height="17" border="0" /> &nbsp;Change Picture</a></li>
	<li class="list-group-item text-muted"><a href="menu.php"><img src="img/about.png" width="16" height="12" border="0" /> &nbsp;Info</a></li>
	<li class="list-group-item text-muted"><a href="request.php"><img src="img/friends.png" width="16" height="12" border="0" /> Friends Request
	(<?php 
					
					$member_id=$_SESSION['SESS_MEMBER_ID'];
					$seeall=mysql_query("SELECT * FROM friends WHERE friends_with='$member_id' AND status='unconf'") or die(mysql_error());
					$numberOFRows=mysql_numrows($seeall);
					echo '<font color="red">'.$numberOFRows.'</font>';?>)
	</a></li>
	<li class="list-group-item text-muted"><a href="message.php"><img src="img/m.png" width="16" height="12" border="0" /> &nbsp;Message&nbsp;
	(<?php 
		$member_id = $_SESSION['SESS_MEMBER_ID'];
		$received = mysql_query("SELECT * FROM messages WHERE recipient = '$member_id'")or die(mysql_error());
								$receiveda = mysql_numrows($received);
								echo '<font color="Red">'  .$receiveda .'</font>';


	?>)
	</a></li>
	<!--li class="list-group-item text-muted"><img src="img/community.png" width="16" height="16" border="0" /><a href="coirecommend.php"> Community</a></li-->
	<li class="list-group-item text-muted"><img src="img/community.png" width="16" height="16" border="0" /><a href="community.php" target="popup" 
  onclick="window.open('community.php','popup','width=600,height=600'); return false;">
    Community <i class="fa fa-1x"></i>
    (<?php 
                    $member_id = $_SESSION['SESS_MEMBER_ID'];
                    $received = mysql_query("SELECT * FROM social_new WHERE social_id = '$member_id'")or die(mysql_error());
                                $receiveda = mysql_numrows($received);
                                echo '<font color="Red">'  .$receiveda .'</font>';


                ?>)</a>
	</li>
   <li class="list-group-item text-muted"><img src="img/social.jpeg" width="16" height="16" border="0" />&nbsp;<a href="social.php" target="popup" 
  onclick="window.open('social.php','popup','width=600,height=600'); return false;">
    Social Media <i class="fa fa-1x"></i></a></li>
            </ul> 
               
          
<hr style="width:230px; height: 10px;
    border: 0; box-shadow: inset 0 10px 10px -12px rgba(0, 0, 0, 0.5);">
	<div class="friends">
	<ul id="sddm1">
	<li><img src="img/friends.png" width="16" height="12" border="0" /><b style=" font-family: courier;font-size:17px;color: #f20570;"> &nbsp;Friends
	
	(<?php


//$result = mysql_query("SELECT * FROM friends WHERE  friends_with = '$id' and  member_id!= '$id' and status = 'conf'    OR member_id = '$id' and friends_with != '$id' and status = 'conf' ");
	$result = mysql_query("SELECT `member`.`member_id`,`member`.`FirstName`,`member`.`LastName`,`member`.`profImage`,`friends`.`friends_with` FROM `friends`,`member` WHERE `friends`.`member_id`='$id' and `status`='conf' and `member`.`member_id`=`friends`.`friends_with` ORDER BY `status` ASC");
	
	


	$numberOfRows = MYSQL_NUMROWS($result);	
	echo '<font color="Red">' . $numberOfRows. '</font>';
	?>)</b>
	
	</li><br>
	</ul>
	<ul id="sddm1">
	
		
		<?php 
		if($numberOfRows>0)
		{
		while($row_1 = mysql_fetch_array($result))
		{
			echo '<li> <a href=friendprofile.php?id='.$row_1["member_id"].' style="text-decoration:none;line-height:5px;"><img src="'. $row_1['profImage'].'" height="50" width="50" ></br></br><font size=3>'.$row_1['FirstName'].' '.$row_1['LastName'].' </font></a> </li>';
			/*echo '<tr>
				<td><a href="friendprofile.php?id='.$row_1['member_id'].'"><img class="img" src="'.$row_1['profImage'].'" alt="" height="50" width="50"  /></a></td>
				<td align="left"><a style="text-decoration:none;" href="friendprofile.php?id='.$row_1['member_id'].'"><font color="#1d3162" size=2>'.$row_1['FirstName']." ".$row_1['LastName'].'</font></br></a></td>
				</tr>
				';*/
		}	
	}else
	{
		echo '<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You don\'t have friends </li>';
	}
		?>
	

	</ul>

							
							<ul id="sddm1">
							<li><hr width="150"></li>
							</ul>
</div>							
</div> <!--end of leftpane-->
<div class="rightpane">
    <div class="colorless"><b><font size="+2.5">Recommendation</font></b></div>
	 <hr style="width:80%;text-align:left;margin-left:0">
	<ul id="sddm1" style="">
	<!--li><font size="4"><a href="socialcontact.php" style="color:#b3003b; background-color: #E7E4E4; line-height: 2.5em;">Social contact</a></font></li-->	
		<li><font size="4"><a href="userrecommend.php" style="color:#b3003b; background-color: #E7E4E4; line-height: 2.5em;">Recommended User</a></font></li>
		<li><font size="4"><a href="socialrecommend.php" style="color:#b3003b;background-color: #E7E4E4;line-height: 2.5em;">Recommended Social Contacts </a></font></li>
		<li><font size="4"><a href="coirecommend.php" style="color:#b3003b;background-color: #E7E4E4;line-height: 2.5em;">Recommended Community Interest </a></font></li>
		<br>
		

	</ul>
	<br><br><br><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<br>
	 <div class="colorless"><b>People You May Know</b></div>
	 <hr style="width:80%;">
		<div class="ScrollStyle" >	
		<?php

			$sql11_1="SELECT * FROM `member` WHERE `member_id` NOT IN (SELECT `friends_with` FROM `friends` WHERE `member_id`=".$_SESSION['SESS_MEMBER_ID'].") and `member_id` NOT IN (SELECT `member_id` FROM `member` WHERE `community_of_int` ='".$usr_community."') and `member_id`!=1 ORDER BY `member`.`member_id` ASC";
			//echo "SELECT * FROM `member` WHERE `member_id` NOT IN (SELECT `friends_with` FROM `friends` WHERE `member_id`=".$_SESSION['SESS_MEMBER_ID'].") and `member_id` NOT IN (SELECT `member_id` FROM `member` WHERE `community_of_int` ='".$usr_community."') and `member_id`!=1 ORDER BY `member`.`member_id` ASC";
			$result11_1=mysqli_query($conn,$sql11_1);

			while($row1 = mysqli_fetch_array($result11_1))
			{
				echo '
					
						<table>
						<tr>
						<td><a href="friendprofile.php?id='.$row1['member_id'].'"><img class="img" src="'.$row1['profImage'].'" alt="" height="40" width="40"  /></td>
						<td align="left" style="margin-left:30px;"><font color="#1d3162">'.$row1['FirstName']." ".$row1['LastName'].'</font></br><a href="addfriend.php?id='.$row1['member_id'].'" rel="facebox"style="text-decoration:none;color:#8a190c;margin-top:10px;text-align:center;">Add as Friend</a></td>
						</tr>
						</table>
						
						<!--a href="friendprofile.php?id='.$row1['member_id'].'"><img class="img" src="'.$row1['profImage'].'" alt="" height="40" width="40" " /></br>
							<font color="#1d3162">'.$row1['FirstName']." ".$row1['LastName'].'</font>
							
							
						<a href="addfriend.php?id='.$row1['member_id'].'" rel="facebox"style="text-decoration:none;">Add as Friend</a></p-->
							<hr width=200 height=10>
						';
			}
			?>
			</li>
</ul>
		</div>
	</div>
</li>
</ul>
</div>
<div class="middlepane"><!--start of middle pane-->
	<form  name="form1" method="post" action="comment.php" enctype="multipart/form-data">
          	<div id="column-1"> update status| add photos <input type="file" name="fileToUpload" id="fileToUpload"><br>
            <textarea name="message" placeholder="What's in your mind" cols="50" rows="5" id="message" onClick="this.value='';"></textarea>
         
          <input name="name" type="hidden" id="name" value="<?php echo $_SESSION['SESS_FIRST_NAME'];?>"/>
		  <input name="poster" type="hidden" id="name" value="<?php echo $_SESSION['SESS_MEMBER_ID'];?>"/>
          <input name="name1" type="hidden" id="name" value="<?php echo $_SESSION['SESS_LAST_NAME'];?>"/><br><br>
          <input type="submit" name="btnlog" value="Post" class="buttonpost" />&nbsp;&nbsp;&nbsp;&nbsp;
           </div>
    </form>
 <hr size=6 style="background-color:DodgerBlue;width: 60%;float: left;">
 <br>
 <?php
	  
function comment1($mem)
{
	
$result9 = mysql_query("SELECT *,UNIX_TIMESTAMP() - date_created AS TimeSpent FROM comment where member_id='".$mem."'");
//echo "SELECT *,UNIX_TIMESTAMP() - date_created AS TimeSpent FROM comment where member_id='".$mem."'";

 $row9 = mysql_fetch_assoc($result9);
 
 	
 	if($row9["member_id"]!= "")
 	{
 
	do 
	{
		echo '<div class="information">';
	  	echo '<div class="pic1">';
		//$result1 = mysql_query("SELECT * FROM member WHERE member_id='".$_SESSION['SESS_MEMBER_ID'] ."'");
		$result1 = mysql_query("SELECT * FROM member WHERE member_id='".$row9["member_id"]."'");
				
		
	    while($row1 = mysql_fetch_assoc($result1))
	    {
		   echo "<img width=40 height=40 alt='Unable to View' src='" . $row1["profImage"] . "'>";
		}
		echo '<div class="message">';
		//$result1 = mysql_query("SELECT * FROM member WHERE member_id='".$_SESSION['SESS_MEMBER_ID'] ."'");
		$result1 = mysql_query("SELECT * FROM member WHERE member_id='".$row9["member_id"]."'");
		
		// $result1 = mysql_query("SELECT * FROM `friendnamesofmemberid` where friendid='".$_SESSION['SESS_MEMBER_ID'] ."'");
		
		
		
		while($row1 = mysql_fetch_array($result1))
	  	{
	   		 echo " Posted by:<font color=#012a8e> {$row1['FirstName']}"."&nbsp;{$row1["LastName"]}</font>";
	 	}
	 

	  	echo '</br>';
		echo "{$row9['comment']}";
		echo'</br>';
		if($row9["imagefile"]=="")
		{
		}
		else
		{
			echo "<a href='" . $row9["imagefile"] . "' rel=facebox; ><img width=50% height=40% src='" . $row9["imagefile"] . "'></a>";
		}
		echo'</br>';
		echo'</div>';
		
		echo '<div class="kkk">';
		

		$sql_like=mysql_query("SELECT * FROM `likes` WHERE `Comment_ID`='".$row9["comment_id"]."'")or die(mysql_error());
		$result_like = mysql_numrows($sql_like);
		$sql_unlike=mysql_query("SELECT * FROM `dislike` WHERE `Comment_ID`='".$row9["comment_id"]."'")or die(mysql_error());
		$result_unlike = mysql_numrows($sql_unlike);
		
		$sql_comm = mysql_query("SELECT * FROM `postmsg` WHERE `comment_id`='".$row9["comment_id"]."'")or die(mysql_error());
		$result_comm = mysql_numrows($sql_comm);
		
		
		echo'<a class="style" href="deletepost1.php?id=' . $row9["comment_id"] . '">delete</a>&nbsp;&nbsp;
		<a class="style" href="like.php?id='.$row9["comment_id"].'"><img width=20 height=20  src=img/like.png>Like  ('.$result_like.')</a>&nbsp;&nbsp;
		<a class="style" href="dislike.php?id='.$row9["comment_id"].'"><img width=20 height=20  src=img/mini1.png style="margin-top:10px;"> DisLike  ('.$result_unlike.')</a>&nbsp;
		<a class="style" href="postcomment.php?id='.$row9["comment_id"].'">Comment ('.$result_comm.')</a>&nbsp;&nbsp;&nbsp;&nbsp;';

		$days = floor($row9['TimeSpent'] / (60 * 60 * 24));
				$remainder = $row9['TimeSpent'] % (60 * 60 * 24);
				$hours = floor($remainder / (60 * 60));
				$remainder = $remainder % (60 * 60);
				$minutes = floor($remainder / 60);
				$seconds = $remainder % 60;
		if($days > 0)
				echo date('F d Y', $row9['date_created']);
				elseif($days == 0 && $hours == 0 && $minutes == 0)
				echo "few seconds ago";		
				elseif($days == 0 && $hours == 0)
				echo $minutes.' minutes ago';
				echo'<hr width="390">';
			
		echo'</div>';
		echo'</br>';
		echo'</br>';
		
	
	}while($row9 = mysql_fetch_assoc($result9)	);
	echo "</br>";
	}

	
}
$query = "SELECT * FROM `member` WHERE `member_id`!=1 ORDER BY `member`.`member_id` ASC";

	$result = mysql_query($query);
			
	//comment1($_SESSION['SESS_MEMBER_ID']);
	while($row = mysql_fetch_assoc($result))
	{
		$mem1=$row["member_id"];
		comment1($mem1);
	}	
?>
<?php
?>
</br>
</br>
<?php
 echo '</div>';
  echo'</br>';
 
?>
</div>
</ul>
</div>
</div><!--end of middle pane-->
  

	
</body>
</html>
 <?php include 'p_trust.php';?>  