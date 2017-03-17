<?php 
 
include('session_chk.php');?>
<html>
<head>
<title>Admin Home</title>
<link rel="stylesheet" type="text/css" href="includes/style.css" />
</head>
<body>
<table width="64%" align="center" border="0" cellpadding="0" cellspacing="1" >
<?php include('admin_panel_heading.php'); ?>
<tr>
<td width="22%">
<?php include('left_side.php');?></td>

<td width="78%" valign="top">
<p><br/>
Feedback system:</p>

<p>Admin can Add/Edit/Delete</p>
<ul>
<li>Students</li>
<li>Subjects</li>
<li>Feedback Questions</li></ul> 
<p>Example:</p>
<p><ul>
<li>Branch: Computer Science And Engineering  </li>
<li>Set parameter: Student,Semester,Subject</li>
<li>To get the result(excel,graph) click on &quot;<strong>Feedback</strong>&quot; link.  </li>
<li>Feedback Questions: You can change  by editing it.  </li>
<li>Students will rate the Subject's faculty within the range of 5 - 10</li>
<li>You can take backup of your dabatabase.</li></td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td valign="top">&nbsp;</td>
</tr>
</table>

</body>
</html>