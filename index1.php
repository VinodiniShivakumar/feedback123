<?php
  
 include('session_chk_student.php');
  
include("includes/config_db.php");
include("ajax_script.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script src="php_calendar/scripts.js" type="text/javascript"></script>
<title>Student Feedback System</title>
<link rel="stylesheet" type="text/css" href="includes/style.css" />
</head>

<body class="body" bgcolor="#5972a9">
<table width="650" height="561"  border="0" align="center" cellpadding="5" cellspacing="5" >
  
  <tr>
    <td width="650"  valign="bottom" align="center"><p><b><font size="5" >Feedback</font></b></p></td>
  </tr>
  <tr>
    <td width="650" height="126" valign=top>
	<form action="submit_feedback.php" method="post" name="feedback_form" onsubmit="return chkForm();">
      <table width="711" border="0" align="center">        
        <tr>
		  <td width="161">Student ID</td>
		  <td width="173"><label>
            <?php
			$myusername=$_SESSION['myusername'];
			
			
			$sel_para="select s.REGISTRATION_NUMBER,s.STUDENT_NAME ,d.division as section,e.sem_name as SEM,s.SEMESTER as sem_id,s.section as sec_id  from student_info s,division_master d,semester_master e where s.section=d.id and s.semester=e.sem_id  AND  registration_number='$myusername' ";
			
			$res_para=mysql_query($sel_para) or die(mysql_error());
			$result_para=mysql_fetch_array($res_para);
			
			$sel1_para="select count(sub_id) as subcount from subject_master where sem_id in (select semester  from student_info  where registration_number='$myusername' )";
			
			$res1_para=mysql_query($sel1_para) or die(mysql_error());
			$result1_para=mysql_fetch_array($res1_para);
			$subcount=$result1_para['subcount'];
			?>
			 <input type="hidden" name="subcountt" value="<?php echo $result1_para['subcount']?>"/>
            <input type="hidden" name="registration_number" value="<?php echo $result_para['REGISTRATION_NUMBER']?>"/>
			<?php echo $result_para['REGISTRATION_NUMBER'];?>
			
			
          </label>
		</td>
		  <td>&nbsp;</td>
          <td>Student Name </td>
          <td><label>
            
            <input type="hidden" name="student_name" value="<?php echo $result_para['STUDENT_NAME']?>"/>
			<?php echo $result_para['STUDENT_NAME']; ?>
          </label></td>
          
          			          
        </tr>
		
		<tr>
		<td>Semester</td>
          <td>
		  
		  <input type="hidden" name="sem_id" value="<?php echo $result_para['sem_id']?>"/>
			<?php echo $result_para['SEM'];?>
		  	</td>
		<td>&nbsp;</td>
		<td>Section</td>
        <td>
		  
		  <input type="hidden" name="sec_id" value="<?php echo $result_para['sec_id']?>"/>
			<?php echo $result_para['section'];?>
		</td>
		</tr>
		<tr>
         
        </tr>
        
         
		  
        
         
		<tr><td>&nbsp;</td></tr>
		<tr>
          <td colspan="5" align="center">Note: Enter Rating from 5 to 10.</td>
        </tr>
		<a href="logout.php" style="position:relative;left:655px;top:76px;font-size:20px;font-weight:bold;" align="right">Log out</a>
		<tr>
          <td colspan="5">
		  <table width="100%" id="rounded-corner" cellpadding="10" cellspacing="0" border="0" align="center">
		  <thead>
		  <tr >
		     <th width="8%" class="rounded-q1" align="center">ID</th>			 
			 <th width="86%" class="rounded-q1" align="center">Questions</th>
			 <?php
		   
		 //  $result=mysql_query("select count(*) as total from subject_master  where sem_id='".$result_para['sem_id']."'");
//$sub_count=mysql_fetch_assoc($result);
//echo $sub_count['total'];
		   
		  	$sql_que="select * from subject_master where sem_id='".$result_para['sem_id']."' order by sub_id";
			$res_que=mysql_query($sql_que) or die(mysql_error());
			
			while($row_que=mysql_fetch_array($res_que))
			{
				
				 echo "<th>".$row_que['sub_name']."</th>";
			
				
				
			}
			
		  ?>
			 
		  </tr>
		  </thead>
		  <?php
		  	$sql_que="select * from feedback_ques_master";
			$res_que=mysql_query($sql_que) or die(mysql_error());
			$i=1;
			$tab_ind=7;
			while($row_que=mysql_fetch_array($res_que))
			{
				$j=1;
			
			
			
				echo "<tr>";
				echo "<td align=\"center\">".$i."</td>";
				echo "<td>".$row_que['ques']."</td>";
			    
				
				while($j<=$subcount) 
				{
				
				$result = $i  . $j;
				
				
				echo "<td> <input type=\"text\" name=\"ans_$result\" size=\"3\" onkeypress=\"return isNumberOnly(event);\" maxlength=\"2\" tabindex=\"$tab_ind\" /></td>";$tab_ind++;
				$j++;}
			$tab_ind++;
				echo "</tr>";
				$i++;
			}
		  ?>		  
		  
		  <tr>
		  <td>Remark:</td>
		  <td colspan="2"><textarea name="remark" style="width:605px; height:40px;" onkeypress="return isCharOnly(event);" tabindex="16"></textarea></td>
		  </tr>		  
		  	<tr>
				<td colspan="2"  class="rounded-foot-left" align="center"><input class="button" type="submit" name="submit" value="Submit" tabindex="17"/>&nbsp;<input type="reset" name="reset" value="Reset" tabindex="18" class="button"/></td>
				<td align="center" class="rounded-foot-right"></td>
			</tr>			
		  </table>
		  </td>
        </tr>
      </table>
    </form></td>
  </tr>
  <tr>
    <td width="697"  height="1"><?php include("footer.php")?></td>
  </tr>
  
</table>
</body>
</html>


<SCRIPT LANGUAGE="JavaScript">

var mikExp = /[$\\@\\!\\\#%\^\&\*\(\)\[\]\+\_\{\}\`\~\=\|]/;
function dodacheck(val) {
var strPass = val.value;
var strLength = strPass.length;
var lchar = val.value.charAt((strLength) - 1);
if(lchar.search(mikExp) != -1) {
var tst = val.value.substring(0, (strLength) - 1);
val.value = tst;
   }
}

//  End -->
</script>

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
function isNumberOnly(e)
{
	var unicode=e.charCode? e.charCode : e.keyCode
	if (unicode!=8 && unicode!=9)
	{ //if the key isn't the backspace key (which we should allow)
		 //disable key press
		//if (unicode==45)
		//	return true;
		if (unicode<48||unicode>57) //if not a number
			return false
	}
}
function chkForm(form)
{

		var RefForm = document.feedback_form;
		for(i=1;i<=10;i++)
		{for(j=1;j<=eval("document.feedback_form.subcountt").value;j++){
		if(eval("document.feedback_form.ans_"+i+j).value == '')
			{
				alert("Enter rating.");
				eval("document.feedback_form.ans_"+i+j).focus();	
				return false;
			}
			if(eval("document.feedback_form.ans_"+i+j).value < 5 ||eval("document.feedback_form.ans_"+i+j).value > 10 )
			{
				alert("Enter rating from 5 to 10.");
				eval("document.feedback_form.ans_"+i+j).focus();	
				return false;
			}}
		}
		/**/
		
}
</script>