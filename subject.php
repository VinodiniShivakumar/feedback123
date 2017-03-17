<?php 
		  include('session_chk.php');
	  include("includes/config_db.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Faculty's Subject</title>
<link rel="stylesheet" type="text/css" href="includes/style.css" />
</head>

<body>
<table width="57%" align="center"  border="0" cellpadding="0" cellspacing="1">
<?php include('admin_panel_heading.php'); ?>
<tr>
<td width="22%" >
<?php include('left_side.php');?>
</td>

<td width="78%" align="center" valign="top" >
<table align="center" width="100%"><tr><td colspan="3" >
<?php
	    $f_result = mysql_query("SELECT * FROM subject_master  ");
	
		$f_myrow = mysql_fetch_array($f_result);
		//print_r($f_myrow);
?>
<tr>
	
	

</table>

<table width="480px">
<tr >
<td align="right"><a href="add_subject.php" class="button">Add Subject</a></td>
</tr>
</table>

<table width="100%" id="rounded-corner" border="0" align="center" cellpadding="1" cellspacing="0" >
<thead>
<tr>
	<th align="center" scope="col" class="rounded-company">Id</th>
	<th align="center" scope="col" class="rounded-q1">Subject Name</th>
	<th align="center" scope="col" class="rounded-q1">Semester</th>
	
	
</tr>
</thead>
<?php


        $result = mysql_query("SELECT * FROM subject_master  ");
        //lets make a loop and get all news from the database
		$i=1;
		if(mysql_num_rows($result)>0)
		{
			 while($myrow = mysql_fetch_array($result))
			 {//begin of loop
			   //now print the results:
			   echo '<tr>';
			   echo "<td align=center>".$i."</td>";$i++;
			   echo "<td align=center>".$myrow['sub_name']."</td>";
			   echo "<td align=center>".$myrow['sem_id']."</td>";
			   
		
			  echo '</tr>';  
			  
			 }//end of loop
		}
		else
		{
			echo '<tr><td colspan=6 align=center>No record found!</td></tr>';
		}
		 
?>
</table>
</td>
</tr>
</table>
</body>
</html>
