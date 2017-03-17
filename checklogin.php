<?php
session_start();
include("includes/config_db.php");
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="feedbackdb"; // Database name 
$tbl_name="users";
 // Table name 

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

// username and password sent from form 
$myusername=$_POST['myusername']; 
$mypassword=$_POST['mypassword']; 

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);
$sql="SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1 && $myusername=="admin"){

// Register $myusername, $mypassword and redirect to file "login_success.php"
$_SESSION['myusername']="admin";
 
header("location:login_success.php");
}
else if($count==1){
$_SESSION['myusername']=$myusername;
 
header("location:index1.php");
}
else {
echo "Wrong Username or Password";

echo "<br/><input type=\"button\" name=\"Back\" value=\"Back\"  onclick=\"javascript: history.go(-1)\" />";
}

?>