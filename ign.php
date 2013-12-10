<?
define("C_MOD",1);
include("inc/functions.php");
if($mode=="myign") $title=$lang['myignlist'];
else $title=$lang['meignlist'];
?>
<html>
<head><title><?echo$title;?></title>
<meta http-equiv="content-type" Content="text/html;charset=windows-1251">
<style>
body,table,tr,td,select,input {font-family:Verdana;font-size:10px;}
.t1 {background-color: #efefef}
.t2 {background-color: #ffffff}
</style>
<script language=JavaScript>
<!--
window.moveTo((screen.width-750)/2 , ((screen.height-500)/2)-50);
//-->
</script></head>
<body>
<center><h2><?echo$title;?></h2><?
if($mode=="myign")
  {
  echo "<table align=center cellpadding=2 cellspacing=1 width=100%>";
  echo "<tr align=center bgcolor=#EFEFEF>
  <td><b>$lang[user]</b></td>
  <td><b>$lang[action]</b></td>";
  $query_ign=mysql_query("select ignores from chat_ignore where user='$_SESSION[suser]' order by id desc") or die(mysql_error());
  while($array_ign=mysql_fetch_array($query_ign))
    {
    echo "<tr bgcolor=#ffffff onmouseover=\"this.className='t1'\" onmouseout=\"this.className='t2'\">";
    echo "<td align=center>$array_ign[ignores]</td>";
    echo "<td align=center><a href=\"hidden.php?unignore=$array_ign[ignores]\">$lang[del]</a></td>";
    echo "</tr>";
    }
  echo "</table>";
  }
else
  {
  echo "<table align=center cellpadding=2 cellspacing=1 width=100%>";
  echo "<tr align=center bgcolor=#EFEFEF>
  <td><b>$lang[user]</b></td></td>";
  $query_ign=mysql_query("select user from chat_ignore where ignores='$_SESSION[suser]' order by id desc") or die(mysql_error());
  while($array_ign=mysql_fetch_array($query_ign))
    {
    echo "<tr bgcolor=#ffffff onmouseover=\"this.className='t1'\" onmouseout=\"this.className='t2'\">";
    echo "<td align=center>$array_ign[user]</td>";
    echo "</tr>";
    }
  echo "</table>";
  }
?></body></html>