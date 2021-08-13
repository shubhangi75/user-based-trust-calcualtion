<?php include('connect.php');?>	
<?php
 $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';

		//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
///
		$vfname = "";
		$vlname = "";
		$vlogin="";
		$vpassword="";
		$vcpassword="";
	    $vaddress="";
		$vcnumber="";
		$vemail="";

		$a="";
		$u="";
		$e="";
		
		
		
//

		$fname = "";
		$lname = "";
		$login="";
		$password="";
		$cpassword="";
	    $address="";
		$cnumber="";
		$email="";
		
if (isset($_POST['Submit'])) {
	
	//Sanitize the POST values
	$fname = ($_POST['fname']);
	$lname = ($_POST['lname']);
	$login =($_POST['login']);
	$password = md5($_POST['password2']);
	$cpassword = md5($_POST['cpassword']);
	$address = ($_POST['address']);
	$cnumber =($_POST['cnumber']);
	$email = ($_POST['email']);
	$gender = ($_POST['gender']);
	//$bdate = clean($_POST['bdate']);
	$propic = ($_POST['propic']);
	$bday=$_POST['month'];
	$Coi = ($_POST['Coi']);
	$interest = ($_POST['Iin']);
	echo "chk:".$interest;
  	
	$pattern = "/^([a-z0-9])(([-a-z0-9._])*([a-z0-9]))*\@([a-z0-9])(([a-z0-9-])*([a-z0-9]))+(\.([a-z0-9])([-a-z0-9_-])?([a-z0-9])+)+$/i";
	//Input Validations
		
	if (!preg_match($pattern,$email)){
	$e = "Invalid Email Address";	
}

if ($email=="") {
		$e	= "";
		}
	if ($fname=="") {
		$vfname	= "<td>Field Missing.</td>";
		}else{
		$vfname="";
		}

	if ($lname==""){
	$vlname	= "<td>Field Missing.</td>";
		}else{
		$vlname="";
		}
	if ($login=="") {
	$vlogin	= "<td>Field Missing.</td>";
	} else{
	$vlogin = "";
	}
		if ($password=="") {
		$vpassword	= "<td>Field Missing.</td>";
	} else{
	$vpassword="";
	}
		if ($cpassword=="") {
		$vcpassword	= "<td>Field Missing.</td>";
	} else{
	$vcpassword="";
	}
	if ($address=="") {
	$vaddress	= "<td>Field Missing.</td>";
	} else{
	$vaddress="";
	}

			if ($cnumber=="") {
		$vcnumber= "<td>Field Missing.</td>";
	} else{
	$vcnumber="";
	}
	if ($email=="") {
		$vemail	= "<td>Field Missing.</td>";
	} else{
	$vemail="";
	}
	
	if($cpassword!=$password){
	$a="Password do not Match";}
	if ($cpassword==""){
	$a="";
	}

	
	//Check for duplicate login ID
	if($login != '') {
		$query = "SELECT * FROM member WHERE UserName='$login'";
		$result = mysql_query($query);
		if($result) {
			if(mysql_num_rows($result) > 0) {
			$u = 'UserName already in use';
			
			}
			@mysql_free_result($result);
		}
		else {
		
			die("Query failed");
		}
	}
	
	
	
	

if ($fname!= "" && $lname!= "" && $login!= "" && $password!= "" && $cpassword==$password && $address!="" && preg_match($pattern,$email) && $cnumber!="" ) {
		$link = mysql_connect("localhost", "root", "");
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	
	}
	
	//Select database
	$db = mysql_select_db("db");
	if(!$db) {
		die("Unable to select database");
	}
				$randvalue=0.0;
				$dt=date("Y-m-d");
				
		
				$query = mysql_query("INSERT INTO member(UserName, Password, FirstName, LastName, Address, ContactNo, Url, Birthdate, Gender, profImage,curcity,ipid,community_of_int,trustvalue,DateAdded,interest)VALUES('$login','$password','$fname','$lname','$address','$cnumber','$email','$bday','$gender','$propic','$address','$ipaddress','$Coi','$randvalue',$dt,'$interest')")or die(mysql_error());  
				
				
				
				$sql13 = mysql_query("SELECT * FROM member where UserName='".$login."' and Password='".$password."' and ContactNo='".$cnumber."' and Url='".$email."' ")or die(mysql_error());
				$row13=mysql_fetch_array($sql13);
				//echo "memberid of user: ".$row13['member_id'];
				$query14 = mysql_query("INSERT INTO trust_rating (User) VALUES ('".$row13['member_id']."')")or die(mysql_error());  
				
				header('Location: signup-success.php');
				//echo "login success";


		}
	
	

}
?>
<html>
<head><title>index</title></head>

<style type="text/css">
<!--
body {
background-color:#d9deeb;
}
.top {
   
    background:#3b5780; border-bottom: 3px solid #133783; background-image: linear-gradient(#4e69a2, #3b5998 50%);
    padding: 10px; 
    width: 100%;
    height: 110px; margin-top:-10px;
	margin-left:-10px;
}

.topbottom
{
margin-top:10px; color:#FFFFFF; font-size:16px;margin-left:150px; padding:0 0 0 0; float:right; margin-right:120px;
}
-->
</style>
<link href="index.css" rel="stylesheet" type="text/css" />
<link rel="icon" href="img/icon.png" type="image" />

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="./js/jquery-1.4.2.min.js"></script>
	<link href="facebox1.2/src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
			<link href="../css/example.css" media="screen" rel="stylesheet" type="text/css" />
			<script src="facebox1.2/src/facebox.js" type="text/javascript"></script>
			<script type="text/javascript">

jQuery(document).ready(function($) {
  $('a[rel*=facebox]').facebox() 
  	closeImage   : " ../src/closelabel.png" 
})
</script>


<script>
		!window.jQuery && document.write('<script src="jquery-1.4.3.min.js"><\/script>');
	</script>
	<script type="text/javascript" src="./fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="./fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="./fancybox/jquery.fancybox-1.3.4.css" media="screen" />
 	<link rel="stylesheet" href="style.css" />
	<script type="text/javascript">
		$(document).ready(function() {
			
			
		$("a#example2").fancybox({
				'overlayShow'	: false,
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'elastic'
			});


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

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<!--datepicker -->
<link href="css/datepicker/ui.datepicker.css" type="text/css" rel="stylesheet"/>
<script type="text/javascript" src="js/datepicker/ui.datepicker.js"></script>
<!--datepicker -->
<script type="text/javascript" charset="utf-8">
jQuery(function($){
$(".date").datepicker();
});
</script>

<body>
	<div class="top"> 
		<h2> Dynamic Trust Management for community based application in IoT</h2>
 			<!---form action="login.php" method="post">
			<div class="topbottom">
 				 <div class="label1">
  					 <div class="email">&nbsp;&nbsp;User Name</div>
        				<div class="password">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Password</div>
				 </div>
				 </div>
				 <div class="topbottom">
				 <div class="emailtext" style="width:70%;">
          				<input name="UserName" type="text"/>
          				<input name="Password" type="password"  />
         				 <input name="submit" type="submit" class="greenButton" value="Login" />

        		</div>	</div>
	
       <!--<div class="password">&nbsp;&nbsp;Forgot Password?</div>>
		 <div class="password"> <a href="http://localhost/community/php-forgot-password-recover-code/" name="something" style="color:#FFFFFF">&nbsp;&nbsp; Forgot Password? &nbsp;&nbsp;</a></div>
      </div>
      </form>
   </div--->
 
 <div class="picture">
  <img src="bg/log.png" width="550" height="400" align="left" />
  </div>
  <div class="field">
    <div class="signup">Create an Account.....</div>
	<div class="free"> It's free, and always will be</div><br/>
	<div class="label"> &nbsp;Personal Information</div>
	
	<!---div class="text">
	<!----form  method="POST">
	  	<div class="textleft">First Name:&nbsp;&nbsp;</div>
		<div class="textright"><input name="fname" type="text" class="textfield" maxlength="10" value="<?--php echo $fname; ?>"/><font color="Red"><--?php echo $vfname;?> </font>
		</div>
		<div class="textleft">Last Name:&nbsp;&nbsp;</div>
		<div class="textright"><input name="lname" type="text" class="textfield" value="<---?php echo $lname; ?>"/><font color="Red"><---?php echo $vlname; ?> </font>
		</div>
		<div class="textleft">User Name:&nbsp;&nbsp;</div>
		<div class="textright"><input name="login" type="text" class="textfield" value="<---?php echo $login; ?>"/><font color="Red"><---?php echo $vlogin; ?> </font><font color="Red"> <---?php echo $u; ?></font>
		</div>
		<div class="textleft">Password:&nbsp;&nbsp;</div>
		<div class="textright"><input name="password2" type="password" class="textfield"value="<---?php echo $password; ?>"/><font color="Red"><---?php echo $vpassword; ?> </font>
		</div>
		<div class="textleft">Retype Password:&nbsp;&nbsp;</div>
		<div class="textright"><input name="cpassword" type="password" class="textfield"value="<---?php echo $cpassword; ?>"/><font color="Red"><---?php echo $vcpassword; ?> </font><font color="Red"><---?php echo $a; ?> </font>
		</div>
		<div class="textleft">City:&nbsp;&nbsp;</div>
		<div class="textright"><input name="address" type="text" class="textfield" value="<---?php echo $address; ?>"/><font color="Red"><---?php echo $vaddress; ?> </font>
		</div>
		<div class="textleft">Contact Number:</div>
		<div class="textright"><input name="cnumber" type="text" class="textfield" maxlength="11" size="40" value="<---?php echo $cnumber; ?>" /><font color="Red"><---?php echo $vcnumber; ?> </font>
		<input name="propic" id="dadded" type="hidden" value="upload/default.jpg" /></div>
		<div class="textleft">Email:</div>
		<div class="textright"><input name="email" type="text" class="textfield" value="<---?php echo $email; ?>"><font color="Red"><---?php echo $vemail; ?> </font><font color="Red"><---?php echo $e; ?> </font>
		</div>
		<div class="textleft">Gender:</div>
		<div class="textright">
			<div class="input-container">
			  <select name="gender" id="gender" class="textfield"><---?php echo $vgender; ?> 
                <option >Female</option>
                <option >Male</option>
              </select><br />
			</div>
		</div>
		
		<div class="textleft">Birth Date:</div>
		<div class="textright">
		 
		    <input name="month" type="text" class="date">
		
		  <p>&nbsp; </p>
		  
		</div>
		<br/>
	<!--div class="free"  style="color:#FF6600"> &nbsp;&nbsp;&nbsp;Community Of Interest</div-->
		 
		 <!---div class="textleft">Community Of Interest:</div>
		<div class="textright">
			<div class="input-container">
			<select name="Coi">
			<option value="select_community" selected>--select community--</option> 
			<!---?php $sql = mysql_query("SELECT * FROM tbl_community"); 
			while ($row = mysql_fetch_array($sql)) { 
			
			 echo "<option value='$row[commu_name]'> $row[commu_name] </option>";
			}
			?>
			</select>
			
			</div>
		</div>
		 <div >&nbsp;<br><br></div>
		<div class="textleft">Interest In:</div>
		<div class="textright">
			<div class="input-container">
			<select name="Iin">
			<option value="select_interested" selected>--select--</option> 
			<---?php $sql1 = mysql_query("SELECT * FROM interested_in"); 
			while ($row = mysql_fetch_array($sql1)) { 
			
			 echo "<option value='$row[Name]'> $row[Name] </option>";
			}
			?>
			
			</select>
			</div>
			</div>
		<div class="textleft"></div>
		<br><br>
	  <div class="textright">
	  <br>
	    <input type="submit" name="Submit" value="Sign Up" class="greenButton1" />
	    <input name="ip" type="text" class="textfield" value="<---?php echo $ipaddress; ?>" style="visibility:hidden"><font color="Red"> </font><font color="Red"><---?php echo $e; ?> </font>
	  </div>
		<!--div class="input-container">
	

		<!--<div class="textright"></div>-->
		 
	  <!---/form>
		 </div----->
		 <form  method="POST">
		 <table border="1">
		 	<col width="150">
			<col width="150">
		 	<tr>
				<td> <label> First Name </label></td>
				<td> <input name="fname" type="text" class="tb5" maxlength="10" value="<?php echo $fname; ?>"/><font color="Red"><?php echo $vfname;?> </font></td>
			</tr>
			<tr>
				<td> <label> Last Name </label></td>
				<td> <input name="lname" type="text" class="tb5" value="<?php echo $lname; ?>"/><font color="Red"><?php echo $vlname; ?> </font></td>
			</tr>
			<tr>
				<td> <label> User Name:  </label></td>
				<td> <input name="login" type="text" class="tb5" value="<?php echo $login; ?>"/><font color="Red"><?php echo $vlogin; ?> </font><font color="Red"> <?php echo $u; ?></font></td>
			</tr>
			<tr>
				<td> <label> Password: </label></td>
				<td> <input name="password2" type="password" class="tb5" value="<?php echo $password; ?>"/><font color="Red"><?php echo $vpassword; ?> </font></td>
			</tr>
			<tr>
				<td> <label>Confirm Password: </label></td>
				<td> <input name="cpassword" type="password" class="tb5" value="<?php echo $cpassword; ?>"/><font color="Red"><?php echo $vcpassword; ?> </font><font color="Red"><?php echo $a; ?> </font></td>
			</tr>
			<tr>
				<td> <label>City:</label></td>
				<td> <input name="address" type="text" class="tb5" value="<?php echo $address; ?>"/><font color="Red"><?php echo $vaddress; ?> </font></td>
			</tr>
			<tr>
				<td> <label>Contact Number: </label></td>
				<td> <input name="cnumber" type="text" class="tb5" maxlength="11" size="40" value="<?php echo $cnumber; ?>"/><font color="Red"><?php echo $vcnumber; ?> </font>
				<input name="propic" id="dadded" type="hidden" value="upload/default.jpg" />
				</td>
			</tr>
			<tr>
				<td> <label>Email Id: </label></td>
				<td> <input name="email" type="text" class="tb5" value="<?php echo $email; ?>"/><font color="Red"><?php echo $vemail; ?> </font><font color="Red"><?php echo $e; ?> </font></td>
			</tr>
			<tr>
				<td> <label>Gender</label></td>
				<td> <div class="input-container">
			  <select name="gender" id="gender" class="tb5"><?php echo $vgender; ?> 
                <option >Female</option>
                <option >Male</option>
              </select><br />
			</div></td>
			</tr>
			<tr>
				<td> <label>Birth Date</label></td>
				<td> <input name="month" type="text" class=" date tb5 "/></td>
			</tr>
			<tr>
				<td> <label>Community Of Interest:</label></td>
				<td> <div class="input-container">
			<select name="Coi" class="tb5">
			<option value="select_community" selected>--select community--</option> 
			<?php $sql = mysql_query("SELECT * FROM tbl_community"); 
			while ($row = mysql_fetch_array($sql)) { 
			
			 echo "<option value='$row[commu_name]'> $row[commu_name] </option>";
			}
			?>
			</select>
			
			</div></td>
			</tr>
			<tr>
				<td> <label>Interest In:</label></td>
				<td> <div class="input-container">
			<select name="Iin" class="tb5">
			<option value="select_interested" selected>--select--</option> 
			<?php $sql1 = mysql_query("SELECT * FROM interested_in"); 
			while ($row = mysql_fetch_array($sql1)) { 
			
			 echo "<option value='$row[Name]'> $row[Name] </option>";
			}
			?>
			
			</select>
			</div></td>
			</tr>
		</table>
		<div class="textright">
	  <br>
	    <input type="submit" name="Submit" value="Sign Up" class="greenButton1" />		
		</div> 
		</form>
</div>		 
		 

</body>
</html>
