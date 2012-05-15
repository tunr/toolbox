<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>

<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Project Tools</title>

<link rel="stylesheet" href="<?php echo base_url(); ?>css/default.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/print.css" type="text/css" media="print">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css" type="text/css" media="all">

</head>
<body class="proj pageid3071">
<div class="fullpage">

<form id="myform" name="myform" action="#" method="post">

<div class="pageheaderbox">
<table class="pageheader">
<tbody><tr>
<td nowrap="nowrap"><a name="top"></a><div class="logo">&nbsp;</div>
<h1>Widget Pro Beta</h1><div class="sitedesc"></div>
</td>
<td valign="bottom" align="right">

<table><!--userinfo-->
<tbody><tr>
  <td class="projjump" align="right" nowrap="nowrap">Your Projects:
  <select id="DefaultProjectID" name="DefaultProjectID">
  <option value="{F5571A91-8053-4E0F-949A-1D9EFF70F027}">Basic Project</option>
  <option value="{F217B62F-EBB0-4853-86AB-FB4BEA635350}">Cosine Pro Beta</option>
  <option value="{1C6CBF09-3040-440A-9E43-4F28594EA78E}">Stainless 2010 Beta</option>
  <option value="{D7C60007-FF84-460A-9637-6519343D35CB}">Tangent 2010 Alpha</option>
  <option value="{39849E75-B8DD-4E48-9709-DA583F381335}">Vandelay Beta</option>
  <option value="{5FF1FAE0-1F33-4234-9877-FF4A923A69E2}" selected="selected">Widget Pro Beta</option>
  <option value="{A8694305-5707-4371-90CD-5BE2D9A903AA}">Widget Pro Beta (Par...</option>
  <option value="{1502A083-8B18-4240-8552-8212B2D79023}">Widget Pro Beta (Rou...</option>
  <option value="{555A40DE-2139-4A72-9C65-F496BE41892C}">Widget Pro Beta 2</option>

   </select>
  </td>
</tr>
      
<tr>
<td class="userinfo" align="right" nowrap="nowrap"><span class="loggedin">Logged In: <a href="#" title="Click here to adjust your personal settings.">Project Manager</a></span></td>
</tr>
<tr>
<td height="6"></td>
</tr>
</tbody>
</table> <!--userinfo-->

</td>
</tr>
</tbody>
</table> <!--pageheader-->

</div>
<div class="bartopbox">
<table class="bartop">
<tbody><tr>
<td class="barl"></td>
<td class="barm bartrail" align="left" nowrap="nowrap"><div class="location">&nbsp;<a href="#">Home</a> &gt; <a href="#">Widget Pro Beta</a> &gt; Project Tools&nbsp;</div></td>

<td class="barm barkb" align="right">

<input id="searchenter" name="searchenter" value="" type="hidden">
<input autocomplete="off" name="stxt" id="stxt" size="18" class="txt" tabindex="10" type="text">
<select name="sarea" id="sarea" tabindex="10" class="sel">
<option value="0" selected="selected" class="opt">Global</option>
<option value="1" class="opt">Feedback</option>
<option value="2" class="opt">Surveys</option>
<option value="3" class="opt">Content</option>
<option value="9" class="opt">Wikis</option>
<option value="4" class="opt">Releases</option>
<option value="5" class="opt">User Forums</option>
<option value="8" class="opt">Users</option>
</select>
<input name="search" value="Search" tabindex="10" class="btn inline" type="button">
<a class="advanced" href="#">Advanced</a><span id="autoCompleted" class="clsAutoCompleted"></span>

</td>

<td class="barr"></td>
</tr>
</tbody></table>
</div> <!-- bartopbox -->
<table>
<tbody><tr>
<td class="leftnavback" valign="top">

<div class="navset project">

<div class="navout">
<div class="navin">
<ul class="nav">
<li class="head projectmanagement">Project Management</li>
<li class="sel"><a href="#" class="itemseltxt">Project Tools</a></li>

<?php if ( ! empty($toolbox_menu_list)): ?>
  <?php foreach($toolbox_menu_list as $row): ?>
    <li id="menu_<?php echo $row['id']; ?>" class="menu_sort"><a href="#" class="itemtxt"><?php echo $row['name']; ?></a></li>
  <?php endforeach; ?>
<?php endif; ?>

<!--
<li id="menu_17" class="menu_sort"><a href="#" class="itemtxt">Reports</a></li>
-->

<li style="display: none;" id="menusortbase"></li></ul>
</div>
</div>

<div class="navout">
<div class="navin">
<ul class="nav">
<li class="head givefeedback">Give Feedback</li>
<li><a href="#" class="itemtxt">Submit a Bug</a></li>
<li><a href="#" class="itemtxt">Submit a Suggestion</a></li>
</ul>
</div>
</div>

<div class="navout">
<div class="navin">
<ul class="nav">
<li class="head trackfeedback">Track Feedback</li>
<li><a href="#" class="itemtxt">Track Bugs</a></li>
<li><a href="#" class="itemtxt">Track Suggestions</a></li>
</ul>
</div>
</div>

<div class="navout">
<div class="navin">
<ul class="nav">
<li class="head wikis">Wikis</li>
<li><a href="#" class="itemtxt">Beta Docs</a></li>
</ul>
</div>
</div>

<div class="navout">
<div class="navin">
<ul class="nav">
<li class="head resources">Resources</li>
<li><a href="#" class="itemtxt">User Forums</a></li>
<li><a href="#" class="itemtxt">Agreements</a></li>
<li><a href="#" class="itemtxt">Beta Releases</a></li>
<li><a href="#" class="itemtxt">Test Content</a></li>
</ul>
</div>
</div>

</div><!--navset-->

<img src="<?php echo base_url(); ?>img/s.gif" class="leftnavwidth noheight" alt="" height="1"></td>

<td class="bbl" valign="top"><div class="btl">&nbsp;</div></td>
<td class="bodyarea" valign="top">