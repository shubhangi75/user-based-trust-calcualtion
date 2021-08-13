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
				
		
				$query = mysql_query("INSERT INTO member(UserName, Password, FirstName, LastName, Address, ContactNo, Url, Birthdate, Gender, profImage,curcity,ipid,community_of_int,trustvalue,DateAdded,Iin)VALUES('$login','$password','$fname','$lname','$address','$cnumber','$email','$bday','$gender','$propic','$address','$ipaddress','$Coi','$randvalue',$dt,$interest)")or die(mysql_error());  
				
				
				
				$sql13 = mysql_query("SELECT * FROM member where UserName='".$login."' and Password='".$password."' and ContactNo='".$cnumber."' and Url='".$email."' ")or die(mysql_error());
				$row13=mysql_fetch_array($sql13);
				//echo "memberid of user: ".$row13['member_id'];
				$query14 = mysql_query("INSERT INTO trust_rating (User) VALUES ('".$row13['member_id']."')")or die(mysql_error()); 
				$qry="SELECT * FROM social WHERE id= '".$row13['member_id']."'" ;
				$run=mysql_query($qry);
				$row1=mysql_fetch_assoc($run);
				$arr_a=explode(",", $row1['Account']);
				$aar_o=explode(",", $row1['Online']);
				foreach ($arr_a as $key) {
					foreach ($$arr_o as $key1) {
						$insert="INSERT INTO social_new (Account,Online,social_id) VALUES ('$key','$key1','".$row13['member_id']."') ";
						$execute=mysql_query($insert);
					}
					
				}
				
				header('Location: signup-success.php');
				echo "login success";


		}
	
	

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Index Page</title>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="css/style.css" rel="stylesheet" id="main-css">
<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<style>
body{
	background-color:#d9deeb;
}
.top {
   
    background:#3b5780; border-bottom: 3px solid #133783; background-image: linear-gradient(#4e69a2, #3b5998 50%);
    padding: 10px; 
    width: 100%;
    height: 150px;
	margin-left:-10px;
}
.leftlabel
{
	margin-top:30px;
	color:#FFFFFF;
	margin-left:40%;
	font-weight:bold;
	font-family:"Courier New", Courier, monospace;
}
.textbox{
	width:200px;
	height::100px;
}
.button
{
	word-spacing:inherit;
	background-color:#4591E4;
	border:1px solid white;
	width:100px;
	height:25px;
	color:#FFFFFF;
	margin-left:0%;font-weight:bolder;
	font-family:"Courier New", Courier, monospace;font-weight:bold;

}
.link{
	width: 223px;
	float:right;
	margin-right: 10px;
	margin-top:5px;}
h1{
	color:#FFFF00; margin-right:60px; 
	text-shadow: 0 1px 0 #ccc,
				  0 2px 0 #c9c9c9,
				  0 3px 0 #bbb,
				  0 4px 0 #b9b9b9,
				  0 5px 0 #ff1a75,
				  0 4px 1px rgba(0,0,0,.1),
				  0 0 10px rgba(0,0,0,.1),
				  0 1px 3px rgba(0,0,0,.3),
				  0 8px 5px rgba(0,0,0,.2),
				  0 10px 10px rgba(0,0,0,.25),
				  0 5px 10px rgba(0,0,0,.2),
				  0 20px 20px rgba(0,0,0,.15); font-size:40px;
	margin-top:20px;
	text-align:center;}
.picture
{
		width:536px;
		margin-top: 100px; margin-left: 18px; width: 450px;
		float:left;
}
/*.picture {
  height: 100vh; margin-top: 100px; margin-left: 18px; width: 450px;
float:left;
}

/**......*/

.form-signin
{
    max-width: 330px;
    padding: 15px;
    margin: 0 auto;
}
.form-signin .form-signin-heading, .form-signin .checkbox
{
    margin-bottom: 10px;
}
.form-signin .checkbox
{
    font-weight: normal;
}
.form-signin .form-control
{
    position: relative;
    font-size: 16px;
    height: auto;
    padding: 10px; margin-bottom:auto;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
.form-signin .form-control:focus
{
    z-index: 2;
}
.form-signin input[type="text"]
{
    margin-bottom:5px;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
}
.form-signin input[type="password"]
{
    margin-bottom: 10px; 
    border-top-left-radius: 0;
    border-top-right-radius: 0;
}
.account-wall
{
    margin-top: 50px; width:500px; height:400px; float:right;
    padding: 40px 0px 20px 0px;
    background-color: #f7f7f7;
	/*border:solid; margin-left:50px; margin-right:50px;*/
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);*/
}
.login-title
{
    color: #555;
    font-size: 18px;
    font-weight: 400;
    display: block; text-align:center;
}

.need-help
{
    margin-top: 10px;
}
.new-account
{
    display: block;
    margin-top: 10px;
}


</style>
</head>

<body> 
<div class="top"> <h1> Dynamic Trust Management for community based application in IoT</h1>
</div>
  <div class="picture">
		<img src="bg/log.png" width="600" height="330" />
  </div>
  </div>
  
            
  <div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
		<div class="account-wall">
            <h2 class="text-center login-title" style="font-size:25px">Sign in to continue.....</h2>
                
                <form action="login.php" method="post"class="form-signin">
                <input type="text" name= "UserName" class="form-control" placeholder="User Name" required autofocus>
                <input type="password" name="Password" class="form-control" placeholder="Password" required>
				<input type="submit" name="submit" style="font-size:24px" value="login" class="btn btn-lg btn-primary btn-block" />
                <!--button class="btn btn-lg btn-primary btn-block" type="submit" style="font-size:24px" value="login">
                    Login</button-->
                <label class="checkbox pull-left">
                    <input type="checkbox" value="remember-me">
                    Remember me
                </label>
                <a href="http://localhost:81/community/php-forgot-password-recover-code/"  name="something" class="pull-right need-help">Forget Password </a><span class="clearfix"></span>
                </form>
           
            <a href="regiform.php" class="text-center new-account" style="font-size:20px;">Create an account </a>
        </div>
    </div>
</div>
 </div>
  
  
</body>
</html>
