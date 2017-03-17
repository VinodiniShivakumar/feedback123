<?php 
  include('session_chk.php');
	  include("includes/config_db.php");
	  
	  include("ajax_script.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script src="php_calendar/scripts.js" type="text/javascript"></script>
<title>Feedback</title>
<link rel="stylesheet" type="text/css" href="includes/style.css" />
</head>

<body>

<?php
/*if(isset($_POST['Reset']))
{
	$b_name='';
	$fac_nam='';
	$sem_name='';
	$sub_name='';
}*/
if(isset($_POST['Submit']) || isset($_POST['xls_file']))
{	$query_string='';
	
	if(isset($_POST['division']))
	{
		$query_string.=" division_id='".$_POST['division']."' and";
		$division=$_POST['division'];
	}
	
	if(isset($_POST['sem_name']))
	{
		$query_string.=" sem_id='".$_POST['sem_name']."' and";
		$sem_name=$_POST['sem_name'];
	}
	if(isset($_POST['sub_name']))
	{
		$query_string.=" sub_id='".$_POST['sub_name']."' ";
		$sub_id=$_POST['sub_name'];
	}
	$slq_search="select feed_id,roll_no,student_name,sem_id,sub_id,division_id,ans1,ans2,ans3,ans4,ans5,ans6,ans7,ans8,ans9,ans10,total,remark,feed_date from feedback_master,student_info where roll_no=registration_number and (".$query_string.")";
	//echo $slq_search;exit; 	
	$res_search=mysql_query($slq_search) or die(mysql_error());
	if($_POST['query_set']=='1')
	{
		$file_name=write_xls($slq_search);				
	}
}
else
{
	$slq_search="select feed_id,roll_no,student_name,sem_id,sub_id,division_id,ans1,ans2,ans3,ans4,ans5,ans6,ans7,ans8,ans9,ans10,total,remark,feed_date from feedback_master,student_info where roll_no=registration_number order by feed_date asc";
	//echo $sql_search;
	
						
	
	$res_search=mysql_query($slq_search) or die(mysql_error());
}


?>
<table width="67%" align="center" border="0" cellpadding="0" cellspacing="1">
<?php include('admin_panel_heading.php'); ?>
<tr>
<td width="14%" bgcolor="#FFFFFF" valign="top">
<?php include('left_side.php');?>
</td>

<td width="86%" align="center" valign="top">
<table align="center" width="100%">
<tr><td colspan="3">
<form name="feedback_form" action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data" onsubmit="return chkForm();">
<table width="100%" cellpadding="2" cellspacing="6">
        <!--<tr>
		  <td width="116">Date</td>
          <td width="166"><label>
            <input type="text" name="date" id="date" readonly tabindex="2"/><a href="javascript:viewcalendar()">cal</a>
          </label></td>
          <td width="118">&nbsp;</td>
          <td width="95">&nbsp;</td>
          <td width="166">&nbsp;</td>
        </tr>-->
        <tr>
         
         
          <td align="left">Semester</td>
          <td align="left" style="position:relative;left:-35px;">
		  <?php
			 $sel_sem="select * from semester_master ";
			 $res_sem=mysql_query($sel_sem) or die(mysql_error());
			
			 while($sem_combo=mysql_fetch_array($res_sem))
			 {							
				$sem_array[] = array('id' => $sem_combo['sem_id'],
									  'text' => $sem_combo['sem_name']);								  
			 }
			 if(isset($sem_name))
			  $default=$sem_name;
			 else
			  $default='';
			 echo tep_draw_pull_down_menu('sem_name',$sem_array,$default,' tabindex="4" ');
	      ?>	
		  
		  </td>
        
         
			<td>&nbsp;</td>
			<td align="left" style="position:relative;left:27px;">Division</td>
          <td align="left" style="position:relative;left:-5px;"><?php
			$sel_div="select * from division_master";
			$res_div=mysql_query($sel_div) or die(mysql_error());
			
			 while($div_combo=mysql_fetch_array($res_div))
			 {							
				$division_combo[] = array('id' => $div_combo['id'],
									      'text' => $div_combo['division']);								  
			 }
			 if(isset($division))
			  $default=$division;
			 else
			 	$default='';
			 
			 echo tep_draw_pull_down_menu('division',$division_combo,$default,' tabindex="3" ');
			 
			?>
			
			</td>                    
        </tr>
		<tr>
		
          <td>&nbsp;</td>
          <td align="left" style="position:relative;left:90px;top:-30px;">Subject Taught </td>
          <td align="left" style="position:relative;left:35px;top:-30px;"><label>
            <?php
			 
			 $sel_sub="select * from subject_master as sm ";
			 $res_sub=mysql_query($sel_sub) or die(mysql_error());
			
			 while($sub_combo=mysql_fetch_array($res_sub))
			 {							
				$sub_array[] = array('id' => $sub_combo['sub_id'],
									  'text' => $sub_combo['sub_name']);								  
			 }
			// print_r($sub_array);// $sub_name;
			 if(isset($sub_id))
			 { $def=$sub_id;}
			 else
			 {	$def='';}
			 //echo $def;
			 echo tep_draw_pull_down_menu_sub('sub_name', $sub_array, $def, ' tabindex="6" ');
	      ?>
		  <!--<select name=sub_name>

          </select>-->
          </label></td></tr>
		  <tr><td colspan="5">&nbsp;</td></tr>
		  <tr>
		  <td colspan="5" align="left">
		  		<input class="button" type="submit" name="Submit" value="Submit" />
		  		<input class="button" type="button" value="Reset" onclick="location.href='<?php echo $_SERVER['PHP_SELF']?>'"> 			
		 
			  <script language="javascript" type="text/javascript">
				function call_overall_graph(encoded_sql_query)
				{	
					url = "graph_img_n_data.php?str=" + encoded_sql_query;
					var win=window.open(url, '_blank');
					win.focus();
				}
				
				function call_que_rating_student_graph(encoded_sql_search_para)
				{
					url = "graph_rating_student_count.php?str=" + encoded_sql_search_para;
					var win=window.open(url, '_blank');
					win.focus();
				}				
			  </script>			 			  	
		  		
			  <?php 
			  if(isset($_POST['Submit'])) 
			  { 
			  	echo '<br/>';		  	
				$encoded_sql_query = base64_encode($slq_search); 
		  		$encoded_sql_search_para = base64_encode($query_string);		
				//echo $encoded_sql_query;	
			  ?>
			  	
				
			  <input class="button" type="button" id="id_overall_graph_button" name="overall_graph_button" value="Avg. report" onclick="javascript:call_overall_graph('<?php echo $encoded_sql_query?>');"/>	
			  <input class="button" type="button" id="id_que_rating_student" name="que_rating_student" value="Overall Rating" onclick="javascript:call_que_rating_student_graph('<?php echo $encoded_sql_search_para?>');"/>			  		  
			  <?php } ?>
			  
			<input type="hidden" name="query" value="<?php echo $slq_search?>" />
			<input type="hidden" name="query_set" value="" />
	  	</td>
		</tr>
		<tr><td colspan="5">&nbsp;</td></tr>
</table>
</form>
</td>
</tr></table>
<table width="480px"><tr><td align=right>Number of Records:- <?php echo mysql_num_rows($res_search);?></td></tr></table>
<table id="rounded-corner"  border="0" align="center" cellpadding="0" cellspacing="0" >
<thead>
<tr>
	<th scope="col" class="rounded-company" align="center">Roll No</th>
	<th scope="col" class="rounded-q3" align="center">Name</th>
	
	<th scope="col" class="rounded-q3" align="center">Ans1</th>
	<th scope="col" class="rounded-q1" align="center">Ans2</th>
	<th scope="col" class="rounded-q2" align="center">Ans3</th>
	<th scope="col" class="rounded-q3" align="center">Ans4</th>
	<th scope="col" class="rounded-q3" align="center">Ans5</th>
	<th scope="col" class="rounded-q3" align="center">Ans6</th>
	<th scope="col" class="rounded-q3" align="center">Ans7</th>
	<th scope="col" class="rounded-q3" align="center">Ans8</th>
	<th scope="col" class="rounded-q3" align="center">Ans9</th>
	<th scope="col" class="rounded-q3" align="center">Ans10</th>
	<th scope="col" class="rounded-q3" align="center">Total</th>
	
	<th scope="col" class="rounded-q3" align="center">&nbsp;</th>
	<th scope="col" class="rounded-q4" align="center">Subject</th>
	<!--<th scope="col" class="rounded-q4" align="center">Edit / Delete</th>-->
</tr>
</thead>

<?php
		if(mysql_num_rows($res_search)!=0)
		{
			$total_ans1=0;
			$total_ans2=0;
			$total_ans3=0;
			$total_ans4=0;
			$total_ans5=0;
			$total_ans6=0;
			$total_ans7=0;
			$total_ans8=0;
			$total_ans9=0;
			$total_ans10=0;
			$Avg=0;
			$total_avg=0;
		    $i=0; 
			 while($myrow = mysql_fetch_array($res_search))
			 {
			   //now print the results:
			   echo '<tr>';
			   $i++;
			   
			   echo "<td align=center>".$myrow['roll_no']."</td>";
			   echo "<td align=center>".$myrow['student_name']."</td>";
			   echo "<td align=center>".$myrow['ans1']."</td>";
			   echo "<td align=center>".$myrow['ans2']."</td>";
			   echo "<td align=center>".$myrow['ans3']."</td>";
			   echo "<td align=center>".$myrow['ans4']."</td>";
			   echo "<td align=center>".$myrow['ans5']."</td>";
			   echo "<td align=center>".$myrow['ans6']."</td>";
			   echo "<td align=center>".$myrow['ans7']."</td>";
			   echo "<td align=center>".$myrow['ans8']."</td>";
			   echo "<td align=center>".$myrow['ans9']."</td>";
			   echo "<td align=center>".$myrow['ans10']."</td>";
			    $Avg= $myrow['ans1']+$myrow['ans2']+$myrow['ans3']+$myrow['ans4']+$myrow['ans5']+$myrow['ans6']+$myrow['ans7']+$myrow['ans8']+$myrow['ans9']+$myrow['ans10'];
			   
			   echo "<td align=center>".$Avg."</td>";
			   echo "<td align=center>".($myrow['remark']!=''?'<a href="javascript: void(0)" 
	onclick="window.open(\'popup.php?feed_id='.$myrow['feed_id'].'\',\'windowname1\',\'width=200, height=77\');return false;" class="button">Remark</a>':'&nbsp;')."</td>";
			   echo "<td align=center>".subject_name($myrow['sub_id'])."</td>";
			    echo '</tr>';  
			  
			  
			  $total_ans1=$total_ans1 + $myrow['ans1'];
			  $total_ans2=$total_ans2 + $myrow['ans2'];
			  $total_ans3=$total_ans3 + $myrow['ans3'];
			  $total_ans4=$total_ans4 + $myrow['ans4'];
			  $total_ans5=$total_ans5 + $myrow['ans5'];
			  $total_ans6=$total_ans6 + $myrow['ans6'];
			  $total_ans7=$total_ans7 + $myrow['ans7'];
			  $total_ans8=$total_ans8 + $myrow['ans8'];
			  $total_ans9=$total_ans9 + $myrow['ans9'];
			  $total_ans10=$total_ans10 + $myrow['ans10'];
			  $total_avg=$total_avg+$Avg;
			  //echo "<br><a href=\"read_more.php?newsid=$myrow[newsid]\">Read More...</a>
			  //  || <a href=\"edit_news.php?newsid=$myrow[newsid]\">Edit</a>
			  //   || <a href=\"delete_news.php?newsid=$myrow[newsid]\">Delete</a><br><hr>";
			 }//end of loop
			 
			 $total_avg= $total_avg/$i;
			  echo '<tr><td align=center>Cumulative--</td>';
			   echo '<td align=center>'.$total_avg.'</td>';
			   echo '<td align=center>&nbsp;</td>';
			 echo '<td align=center>&nbsp;</td>';
			 echo '<td align=center>&nbsp;</td>';
			echo '<td align=center>&nbsp;</td>';
			 echo '<td align=center>&nbsp;</td>';
			echo '<td align=center>&nbsp;</td>';
			 echo '<td align=center>&nbsp;</td>';
			echo '<td align=center>&nbsp;</td>';
			 echo '<td align=center>&nbsp;</td>';
			 echo '<td align=center>&nbsp;</td>';
			 echo '<td align=center>&nbsp;</td>';
			
			 echo '<td align=center>&nbsp;</td>';
			 echo '<td align=center>&nbsp;</td>';
			 
			 
			 echo '</tr>';
		 }
		 else
		 {
		 	 echo '<tr>';
			  echo "<td align=center colspan=11>No Record Found!</td>" ;
			  echo "<td align=center>&nbsp;</td>";
			  echo "<td align=center>&nbsp;</td>";
			  echo "<td align=center>&nbsp;</td>";
			  echo "<td align=center>&nbsp;</td>";
		 }
?>
</table>
</td>
</tr>
</table>
</body>
</html>
<script language="javascript" type="text/javascript">
function chkForm(form)
{
		var RefForm = document.feedback_form;				
		if (RefForm.b_name.value == 0 )
		{
			alert("Select Branch");
			RefForm.b_name.focus();			
			return false;
		}
		if (RefForm.batch_name.value == 0 )
		{
			alert("Select Batch");
			RefForm.batch_name.focus();			
			return false;
		}
		if (RefForm.sem_name.value  == 0 )
		{
			alert("Select Semester");			
			RefForm.sem_name.focus();
			return false;
		}
		if (RefForm.fac_name.value == 0 )
		{
			alert("Select Faculty Name.");			
			RefForm.fac_name.focus();
			return false;
		}
		if (RefForm.sub_name.value == 0 )
		{
			alert("Select Subject");
			RefForm.sub_name.focus();			
			return false;
		}
}
</script>

