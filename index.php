<!DOCTYPE html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="keywords" content="Digital Login Form Widget Responsive, Login form web template, Sign up Web Templates, Flat Web Templates, Login signup Responsive web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<!-- //for-mobile-apps -->
<link href='//fonts.googleapis.com/css?family=Lato:400,100,100italic,300italic,300,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Salsa' rel='stylesheet' type='text/css'>
<!-- js -->
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<!-- js -->
<link href="style1.css" rel="stylesheet" type="text/css" media="all" />
<!-- script for close -->
<script>
$(document).ready(function(c) {
	$('.alert-close').on('click', function(c){
		$('.vlcone').fadeOut('slow', function(c){
			$('.vlcone').remove();
		});
	});	  
});
</script>
<!-- //script for close -->

<style>
body {margin:0;}

.topnav {
  overflow: hidden;
  background-color:#2B4D96;
}

.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 30px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
    background-color: #4CAF50;
    color: white;
}
</style>


</head>
<body>

<div style="position:relative;height:35px;" class="topnav">
  
</div>

 <div style="text-align:center;padding:10px;">
      
        <img src="au.gif" style='width:100%;height:50%'>
      </div>
	 
                 
    
		
			
		<div class="main vlcone">
			<div class="hotel-left">
				<div class="pay_form">
                                                            

    
					<h2 style="font-family:Comic Sans MS;font-weight:bold;font-size:35px;">Login Here</h2>
				<form name="form1" method="post" action="checklogin.php">
						<input class="logo"name="myusername" id="myusername" type="text" value="Username" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Username';}" required="">
						<input class="key" name="mypassword" id="mypassword"type="password" value="Password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" required="">
						<input type="submit" class="button" name="Submit" value="Login">
					</form>
				</div>
				
				
				<div class="clear"></div>
			</div>
			<div class="hotel-right">
				<h3 style="font-family:Comic Sans MS;font-weight:bold;font-size:30px;" >WE CONSIDER<span>STUDENT'S FEEDBACK</span></h3>
				<p style="font-family:Comic Sans MS;font-weight:bold;font-size:20px;">A perfect place for student's opinion.</p>
			</div>
			<div class="clear"></div>
		</div>
<?php
?>		
	<div style="position:relative;top:100px;height:20px;" class="topnav">
  
</div>
</body>
</html>
