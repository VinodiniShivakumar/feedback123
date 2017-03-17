<?php
 include('session_chk_student.php');
include("includes/config_db.php");

if(isset($_POST['submit']))
{
	$subcount=$_POST['subcountt'];
	$registration_number=$_POST['registration_number'];
	//$subject_name=$_POST['sub_name'];
	$name=$_POST['student_name'];
	
	$sql="select * from feedback_master where roll_no='$registration_number' ";
	//echo $sql;
	$res=mysql_query($sql) or die(mysql_error());
	
	//echo mysql_num_rows($res);
	//exit;
	if(mysql_num_rows($res)>=1)
	{
		echo "<p align=\"center\">Feedback is already submited by this '".$_POST['registration_number']."' roll no .<br>You'll be redirected to Home Page after (3) Seconds</p>";
		echo "<meta http-equiv=Refresh content=3;url=index1.php>";
		exit;
	}
	else
	{
	
	
	$j=1;
	  
	   while($j<=$subcount){
		$a=$j-1;
		$sel1_para="select sub_id from subject_master where sem_id in (select semester  from student_info  where registration_number='".$_POST['registration_number']."') order by sub_id asc LIMIT ".$a.",1 ";
			
			$res1_para=mysql_query($sel1_para) or die(mysql_error());
			$result1_para=mysql_fetch_array($res1_para);
			$sub_idd=$result1_para['sub_id'];
		
		
		$sql_insert="insert into feedback_master (roll_no,name, sem_id,sub_id, division_id, ans1, ans2, ans3, ans4, ans5, ans6, ans7, ans8, ans9,ans10, remark, feed_date) values ('".$_POST['registration_number']."','".$_POST['student_name']."','".$_POST['sem_id']."','".$sub_idd."', '".$_POST['sec_id']."', '".$_POST['ans_1'.$j]."','".$_POST['ans_2'.$j]."','".$_POST['ans_3'.$j]."','".$_POST['ans_4'.$j]."','".$_POST['ans_5'.$j]."','".$_POST['ans_6'.$j]."','".$_POST['ans_7'.$j]."','".$_POST['ans_8'.$j]."','".$_POST['ans_9'.$j]."','".$_POST['ans_10'.$j]."','".$_POST['remark']."','".date('Y-m-d')."')";//,strtotime($_POST['date'])
		mysql_query($sql_insert) or die(mysql_error());
		$j++;
		}
		
		$sql_update="update feedback_master set total=ans1+ans2+ans3+ans4+ans5+ans6+ans7+ans8+ans9+ans10 ";
		$sql_update1="update student_info set status1=1 where REGISTRATION_NUMBER='$registration_number'";
		mysql_query($sql_update) or die(mysql_error());
		mysql_query($sql_update1)or die(mysql_error());
		echo "<p align=\"center\">Feedback is submited successfully!<br>You'll be redirected to Home Page after (3) Seconds</p>";
        echo "<meta http-equiv=Refresh content=3;url=index1.php>";
		exit;
	
}}


?>