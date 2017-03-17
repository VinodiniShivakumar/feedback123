<?php 
	  include('session_chk.php');
include("includes/config_db.php");
?> 	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="includes/style.css" />
<title>Add Faculty</title>
</head>

<body>
<table width="57%" align="center" border="0" cellpadding="0" cellspacing="1">
<?php include('admin_panel_heading.php'); ?>
<tr>
<td width="22%" valign="top">
<?php include('left_side.php');?>
</td>

<td width="78%" align="center" valign="top" >
<?php
if(isset($_POST['submit']))
  {//begin of if($submit).
      // Set global variables to easier names
      $student_name = $_POST['student_name'];
	  $registration_number = $_POST['registration_number'];
	  $sem_id = $_POST['sem_name'];
	   $sec_id = $_POST['division'];
	  $DOB=$_POST['DOB'];
	  
     
            
    //check duplication
	$dup="select * from student_info  where registration_number='".$registration_number."'";
	$dup_res=mysql_query($dup) or die(mysql_error());
	if(mysql_num_rows($dup_res)==1)
	{
		echo "Student id is already available in database.";
		 
          echo "<meta http-equiv=Refresh content=1;url=add_faculty.php>";
	}
	else
	{
     
	     //run the query which adds the data gathered from the form into the database
		 $slq_search="INSERT INTO student_info (registration_number,student_name,dob,section,semester) VALUES ('$registration_number','$student_name','$DOB','$sec_id','$sem_id')";
$sql="INSERT INTO users(username,password) VALUES ('$registration_number','$DOB')";	
	$res_search=mysql_query($slq_search) or die(mysql_error());
	$re1=mysql_query($sql) or die(mysql_error());	 
        
          //print success message.
		  
		 
          echo "<b>Student  added Successfully!</b><br>You'll be redirected after (1) Seconds";
          echo "<meta http-equiv=Refresh content=2;url=batch.php>";
         // echo "<!--<meta http-equiv=Refresh content=4;url=index.php>-->";
	}
  }//end of if($submit).


  // If the form has not been submitted, display it!
else
  {//begin of else

      ?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" name="add_fac" onsubmit="return chkForm();">
<table width="283" border="0" cellpadding="3" cellspacing="1">
<tr><td colspan="2" align="center" style="font-size:20px">Add Student</td></tr>
  <tr>
    <td width="92"><div align="left">Registration_Number</div></td>
    <td width="163"><label>
      
        <div align="left">
          <input type="text" name="registration_number" />
        </div>
    </label></td>
  </tr>
  <tr>
    <td width="92"><div align="left">Student Name</div></td>
    <td width="163"><label>
      
        <div align="left">
          <input type="text" name="student_name" onkeypress="return isCharOnly(event);"/>
        </div>
    </label></td>
  </tr>
  <tr>
  
  <tr>
    <td width="92"><div align="left">Date Of Birth</div></td>
    <td width="163"><label>
      
        <div align="left">
          <input type="text" name="DOB" placeholder="Eg:02/07/1997";"/>
        </div>
    </label></td>
  </tr>
  <tr>
  
    <td width="92"><div align="left">Semester</div></td>
    <td width="163">
	  
	    <div align="left">
	      <?php
	 $sel_b="select * from semester_master";
	$res=mysql_query($sel_b) or die(mysql_error());
	
	 while($b_combo=mysql_fetch_array($res))
	 {							
		$branch_combo[] = array('id' => $b_combo['sem_id'],
							   'text' => $b_combo['sem_name']);								  
	 }
	 $default = 1;
	 echo tep_draw_pull_down_menu('sem_name',$branch_combo,$default);
	?>      
	      </div></td>
  </tr>
  <tr>
  <td width="92"><div align="left">Section</div></td>
    <td width="163">
	  
	    <div align="left">
	      <?php
	 $sel_b="select * from division_master";
	$res=mysql_query($sel_b) or die(mysql_error());
	
	 while($seccombo=mysql_fetch_array($res))
	 {							
		$sec_combo[] = array('id' => $seccombo['id'],
							   'text' => $seccombo['division']);								  
	 }
	 $default = 1;
	 echo tep_draw_pull_down_menu('division',$sec_combo,$default);
	?>      
	      </div></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td><div align="left">
      <table border="0" width="100%">
        <tr><td> <input type="submit" class="button" name="submit" value="Add"></td><td align="right"><input type="button" name="Back" value="Back"  onclick="javascript: history.go(-1)" class="button" /></td></tr>
      </table>
    </div></td>
  </tr>
</table>
</form>

 <?php
  }//end of else
?>
<p>&nbsp;</p></td>
</tr>
</table>
</body>
</html>
<script language="javascript" type="text/javascript">
function isCharOnly(e)
{
	var unicode=e.charCode? e.charCode : e.keyCode
	//if (unicode!=8 && unicode!=9)
	//{ //if the key isn't the backspace key (which we should allow)
		 //disable key press
		if (unicode==45)
			return true;
		if (unicode>48 && unicode<57) //if not a number
			return false
	//}
}

function chkForm(form)
{

		var RefForm = document.add_fac;
		if (RefForm.registration_number.value.length != 12 )
		{
			alert("Enter valid Registration_number");	
			RefForm.registration_number.focus();		
			return false;
		}
		if (RefForm.student_name.value.length < 1 )
		{
			alert("Enter student Name");			
			RefForm.student_name.focus();
			return false;
		}
		
		if (RefForm.sem_name.value == 0 )
		{
			alert("Select Semester ");			
			return false;
		}
		
		if (RefForm.division.value == 0 )
		{
			alert("Select division ");			
			return false;
		}
}
</script>