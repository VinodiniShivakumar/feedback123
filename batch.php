<?php 
 	  include('session_chk.php');
	  include("includes/config_db.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="includes/style.css" />
<title>Batch</title>
</head>

<body>
<?php

if(isset($_POST['Submit']) )
{	$query_string='';

     if(isset($_POST['sem_name']) & $_POST['sem_name']!=0)
	{
		$query_string.=" s.SEMESTER ='".$_POST['sem_name']."' and ";
		$sem_name=$_POST['sem_name'];
	}
	 
	 else
	{
		$query_string.="  ";
		
	}
	 if(isset($_POST['verify']) & $_POST['verify']!=0)
	{
		$query_string.=" s.status1 ='".$_POST['verify']."' and ";
		$sta_name=$_POST['verify'];
	}
	 
	 else
	{
		$query_string.="  ";
		
	}
	 
	 if(isset($_POST['division']) & $_POST['division']!=0)
	 {
		 $query_string.="  s.section ='".$_POST['division']."' and "; 
		 $division=$_POST['division'];
	 }
	 else
	{
		$query_string.="  ";
		
	}
	 
	
	 
	 
	 
	 
	 
	
	$sql_search="select s.REGISTRATION_NUMBER,s.STUDENT_NAME ,d.division as section,e.sem_name as SEMESTER,f.verify as status1 from student_info s,division_master d,semester_master e,status f where ".$query_string."   s.section=d.id  and s.semester=e.sem_id and s.status1=f.sid order by registration_number asc";
	//$slq_search="select * from subject";
	
		
	$res_search=mysql_query($sql_search) or die(mysql_error());
	//$res1=mysql_query($slq_search) or die(mysql_error());
}
else
{
	$sql_search="select s.REGISTRATION_NUMBER,s.STUDENT_NAME ,d.division as section,e.sem_name as SEMESTER ,f.verify as status1 from student_info s,division_master d,semester_master e,status f where s.section=d.id and s.semester=e.sem_id and s.status1=f.sid  order by registration_number asc";
	//$slq_search="select * from subject";
	//$res1=mysql_query($slq_search) or die(mysql_error());
	$res_search=mysql_query($sql_search) or die(mysql_error());
}

?>


<table width="57%" align="center" border="0" cellpadding="0" cellspacing="1">

<?php include('admin_panel_heading.php'); ?>

<tr>
<td width="22%">
<?php include('left_side.php');?></td>

<td  align="center" valign="top">
  <table align="center" width="100%">
<tr><td colspan="3">
<form name="student_details" action="<?php echo $_SERVER['PHP_SELF']?>" method="post"  >
<table width="100%" cellpadding="2" cellspacing="6">
        
        <tr>
          <td align="left">Semester </td>
          <td align="left"><label>
            <?php
			$sel_b="select * from semester_master ";
			$res=mysql_query($sel_b) or die(mysql_error());
			
			 while($b_combo=mysql_fetch_array($res))
			 {							
				$branch_combo[] = array('id' => $b_combo['sem_id'],
									    'text' => $b_combo['sem_name']);								  
			 }
			 if(isset($sem_name))
			  $default=$sem_name;
			 else
			 	$default='';
			 
			 echo tep_draw_pull_down_menu('sem_name',$branch_combo,$default,' tabindex="3" ');
			 
    	    
			?>
			
            
          </label></td>
          <td>&nbsp;</td>
		  <td align="left">Status </td>
          <td align="left"><label>
            <?php
			$sel_st="select * from status ";
			$ress=mysql_query($sel_st) or die(mysql_error());
			
			 while($b_combo1=mysql_fetch_array($ress))
			 {							
				$branch_combo1[] = array('id' => $b_combo1['sid'],
									    'text' => $b_combo1['verify']);								  
			 }
			 if(isset($sta_name))
			  $default=$sta_name;
			 else
			 	$default='';
			 
			 echo tep_draw_pull_down_menu('verify',$branch_combo1,$default,' tabindex="3" ');
			 
    	    
			?>
			
            
          </label></td>
          <td>&nbsp;</td>
          <td align="left">Section</td>
          <td align="left">
		  <?php
			 $sel_sem="select * from division_master ";
			 $res_sem=mysql_query($sel_sem) or die(mysql_error());
			
			 while($division_combo=mysql_fetch_array($res_sem))
			 {							
				$div_array[] = array('id' => $division_combo['id'],
									  'text' => $division_combo['division']);								  
			 }
			 if(isset($division))
			  $default=$division;
			 else
			  $default='';
			 echo tep_draw_pull_down_menu('division',$div_array,$default,' tabindex="4" ');
			 
	      ?>	
		  
		  </td>
        </tr>
        
			
         <tr>
				<td colspan="2"  class="rounded-foot-left" align="center"><input class="button" type="submit" name="Submit" style="position:relative;top:30px;left:130px;" value="Submit" tabindex="17"/></td>
				<td align="center" class="rounded-foot-right"></td>
			</tr>	
		
		 <p>
<table width="480px" align="center"><tr><td colspan="3" align="right"><a href='add_student.php' class="button" style="position:relative;left:30px;top:5px;">Add Student</a><a href='./excel1/index.php' style="position:relative;left:50px;top:5px;" class="button">import</a></td></tr></table>
</p>
<tr><td colspan="2" align="left" style=">   Students  <input type="text" style="width:35px;position:relative;left:95px;" value="<?php echo mysql_num_rows($res_search);?>"/></td></tr>


              </form>
			  </table>
  
<center>
<table width="100%" id="rounded-corner" border="0" align="center" cellpadding="0" cellspacing="0" >

<tr>
    <th align="center" scope="col" class="rounded-company">S.No</th> 
	<th align="center" scope="col" class="rounded-q1">Registration_number</th>
	<th align="center" scope="col" class="rounded-q4">Student_name</th>
	<th align="center" scope="col" class="rounded-q4">Semester</th>
	<th align="center" scope="col" class="rounded-q4">Section</th>
	
</tr>


<tbody>
<?php
       
        //lets make a loop and get all news from the database
		$i=1;
		if(mysql_num_rows($res_search)>0)
		{
			while($myrow = mysql_fetch_array($res_search))
			{
			   //begin of loop
			   //now print the results:
			   echo '<tr>';
			   echo "<td align=center>".$i."</td>";$i++;
			   echo "<td align=center>".$myrow['REGISTRATION_NUMBER']."</td>";
			   echo "<td align=center>".$myrow['STUDENT_NAME']."</td>";
			   echo "<td align=center>".$myrow['SEMESTER']."</td>";
			   echo "<td align=center>".$myrow['section']."</td>";
			   echo '</tr>';  
			  
			}//end of loop
			
		}
		else
		{
			echo '<tr><td colspan=6 align=center>No record found!</td></tr>';
		}
?>



</center>
</tbody>
</table>
</body>
</html>
