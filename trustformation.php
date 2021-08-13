<?php
include("connect1.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Trust Calculation</title>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.9/angular.min.js"></script>
<script type="text/javascript">
       angular.module('MyApp', [])
  .controller('MyController', ['$scope',function($scope) {
      $scope.div1 = false;
      $scope.div2 = false;
      $scope.div3 = false;

      $scope.togglediv1 = function() {
        $scope.div1 = true;//!$scope.div1
        $scope.div2 = false;//true;
        $scope.div3 = false;
      }
      $scope.togglediv2 = function() {
        $scope.div2 = true;//!$scope.div2
        $scope.div1 = false;//true;
        $scope.div3 = false;
      }
      $scope.togglediv3 = function() {
        $scope.div3 = true;//!$scope.div2
        $scope.div1 = false;//true;
        $scope.div2 = false;
      }
    }
  ]);
    </script>
</head>
<link rel="stylesheet" type="text/css" href="recommend.css">
<style type="text/css">
	.btn {
  display: inline-block;
  padding: 12px 22px;
  font-size: 22px;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: none;
  color: #fff;
  
  border: none;
  border-radius: 12px;
  box-shadow: 0 9px #999; margin-right: 15px;
}
.btn1{background-color: #7D3C98 ;}
.btn2{background-color: #2874A6 ;}
.btn3{background-color: #117864  ;}

.btn1:hover {background-color: #3e8e41}
.btn2:hover {background-color: #3e8e41}
.btn3:hover {background-color: #3e8e41}

.btn:active {
  background-color: #3e8e41;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}
	
</style>
<body style="background-color:  #ededde">
	<div class="top">
	<hr/>
	
		<h1 align="center"><font color="#f0b52b" style="left:43%; top:5%;letter-spacing: 2px; position:absolute;">Trust Formation </font></h1>
    <a href="adminhome.php" class="previous">Back to Home</a>
  
  <a class="next" href="  index.php">Logout</a>

  </div>
  <br><br>
  <div ng-app="MyApp" ng-controller="MyController" align="center">
	<input type="button" class="btn btn1" value="Direct Trust" ng-click="togglediv1()" />
	<input type="button" class="btn btn2" value="Indirect Trust(Recommendation)" ng-click="togglediv2()" />
	<input type="button" class="btn btn3" value="Trust" ng-click="togglediv3()" />
	<br><br>
	<div ng-show = "div1">
		      <table width="80%" >
      <tr>
        <th>User Name</th><th>Direct Trust</th>
         <?php
        $in="SELECT UserName ,trustvalue FROM `member` WHERE member_id!=1";
        $run=mysqli_query($conn,$in);
         $storeArray = Array();
         while ($row = mysqli_fetch_array($run, MYSQLI_ASSOC)) {
              $storeArray[] =  $row['UserName'];     
              $storeArray[] =  $row['trustvalue']; 
              
            echo " <tr align='center'><td>$row[UserName]</td><td>$row[trustvalue]</td>"; 
         }     


        ?>
      </tr>
    </table>
	</div>	
	<div ng-show = "div2">
    <table width="100%">
      <tr>
        <th>Member_id</th><th>User Name</th><th>User Recommend</th><th>Social Recommend</th><th>COI Recommend</th><th>Total Recommend</th>
      </tr>
        <?php
        $in="SELECT member.member_id,member.UserName ,indirect.user,indirect.social,indirect.coi,indirect.total FROM `member` INNER JOIN `indirect` ON member.member_id=indirect.member_id";
        $run=mysqli_query($conn,$in);
         $storeArray = Array();
         while ($row = mysqli_fetch_array($run, MYSQLI_ASSOC)) {
              $storeArray[] =  $row['member_id']; 
              $storeArray[] =  $row['UserName'];     
              $storeArray[] =  $row['user']; 
              $storeArray[] =  $row['social'];
              $storeArray[] =  $row['coi']; 
              $storeArray[] =  $row['total'];
              
            echo " <tr><td>$row[member_id]</td><td>$row[UserName]</td><td>$row[user]</td><td>$row[social]</td><td>$row[coi]</td><td>$row[total]</td>"; 
         }     


        ?>
      </tr>
    </table>  
	</div>
	<div ng-show = "div3">
		  <table width="100%">
      <tr>
        <th>Member_id</th><th>User Name</th><th>Direct Interaction</th><th>Recommendation</th><th> Community_Trust</th><th> Trust</th>
      </tr>
        <?php
        $in="SELECT * FROM member WHERE member_id!=1";
        $run=mysqli_query($conn1,$in);
        //$num = mysqli_num_rows($run);
      //   $storeArray = Array();
         while ($row = mysqli_fetch_assoc($run)) {


          $sel1 = "SELECT * FROM indirect WHERE member_id = '".$row['member_id']."' ";
          $query1 = mysqli_query($conn1,$sel1);
          $fetch1 = mysqli_fetch_assoc($query1);

          $trust =number_format(($row['trustvalue']+$fetch1['total'])/2,2);
             /* $storeArray[] =  $row['UserName'];
              $storeArray[] =  $row['trustvalue'];       
              $storeArray[] =  $row['total'];*/
              
            //echo "<tr><td>$row[member_id]</td><td>$row[UserName]</td><td>$row[trustvalue]</td><td>$fetch1[total]</td><td>$trust"; 
            $select_c="SELECT * FROM p_trust WHERE member_id= '".$row['member_id']."'";
            $select_run=mysqli_query($conn1,$select_c);
            $row_c=mysqli_fetch_assoc($select_run);
            if($row_c['PT_G']==1)
            {
            $c_trust=number_format((0.1+$row['trustvalue']+$fetch1['total'])/2,2);
          }
            echo "<tr><td>$row[member_id]</td><td>$row[UserName]</td><td>$row[trustvalue]</td><td>$fetch1[total]</td><td>$c_trust</td><td>$trust"; 
           if($trust >= 0.5 )
      {
      echo "<td style='background-color: #c9fccf;'></td></tr>";
      }
    else
    {
      echo "<td style='background-color: #ffbcbc;'><font color='Red'>Not Trusted User</font></td></tr>";
    }
           $select="SELECT * FROM trust_table WHERE member_id='".$row['member_id']."'";
            $sel_run=mysqli_query($conn1,$select);
            $num = mysqli_num_rows($sel_run);
            if($num<=0)
            {
                $insert = "INSERT INTO trust_table(member_id,TrustValue,C_trusr)VALUES('".$row['member_id']."','".$trust."','".$c_trust."')";
            }
            else{    
                 $insert="UPDATE trust_table SET TrustValue = '".$trust."', c_trust='".$c_trust."' WHERE member_id = '".$row['member_id']."'";
               }  
                $up=mysqli_query($conn1,$insert);
            //}    
           // echo $trust;
         }     


        ?>
      </tr>
    </table>
	</div>
</div>	

	

</body>
</html>
