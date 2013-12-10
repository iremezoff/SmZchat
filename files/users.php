<?
if(!defined("F_MOD"))
  {
  echo "<meta http-equiv='refresh' content='0; url=/index.php'>";
  exit;
  }
$_SESSION['upd']=0;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link href="theme/<?echo$skin;?>/main.css" rel="stylesheet" type="text/css">
<script id="JS"></script>
<script language="JavaScript">
document.getElementById("JS").text = window.parent.document.getElementById("JS_all").text;
</script>
</head>
<body bgcolor="<?echo$color['bgcolor'];?>" leftMargin="0" topMargin="0" rightMargin="0" marginheight="0" marginwidth="0">
<table  style="width:100%;" width="100%" align="center" border="0" cellspacing="1" bgcolor="<?echo$color['tableh'];?>" cellpadding="1">
<tr>
<td  valign="middle" bgcolor="<?echo$color['tdbgcolor'];?>" style="padding:3px; font-size:10px; font-family:Tahoma; color:<?echo$color['tdcolor'];?>; virtual-align:middle; Text-decoration: none; height:16; Letter-spacing: 2px;" nowrap>
<a href="#" onselectstart="return false;" onclick="menu_right('users');">
<img id="img_users" src="theme/<?echo$skin;?>/img/st_u.gif" border="0" style="padding-right:5px;"><?echo$lang['now'];?>:</a>
</td>
</tr>
<tr>
<td id="users"  valign="top" align="left" bgcolor="<?echo$color['bgcolor'];?>" style="font-size:<?echo$font;?>; color:<?echo$color['tdcolor'];?>;"><div name="usr" id="usr"><center>... Loading ...</center></div>
</td>
</tr>
</table>

<table  style="width:100%;" width="100%" align="center" border="0" cellspacing="1" bgcolor="<?echo$color['tableh'];?>" cellpadding="1">
<tr>
<td  valign="middle" bgcolor="<?echo$color['tdbgcolor'];?>" style="padding:3px; font-size:10px; font-family:Tahoma; color:<?echo$color['tdcolor'];?>; virtual-align:middle; Text-decoration: none; height:16; Letter-spacing: 2px;" nowrap>
<a href="#" onselectstart="return false;" onclick="menu_right('status');">
<img id="img_status" src="theme/<?echo$skin;?>/img/st_d.gif" border="0" style="padding-right:5px;"><?echo$lang['status'];?>:</a>
</td>
</tr>
<tr id="status" style="display:none;"">
<td valign="top" bgcolor="<?echo$color['bgcolor'];?>" style="font-size:<?echo$font;?>; color:<?echo$color['tdcolor'];?>;" align=center>
<form action="hidden.php" method=get target=hidden name=status>
<input type="hidden" name="ch_status" value="1">
<select name="setstatus" onchange="status.submit();" style="width:150px;font-size:8pt;">
<option value="free"<?if($_SESSION['status']=="free")echo" selected";?>><?echo$lang['tstatus']['free'];?></option>
<option value="away"<?if($_SESSION['status']=="away")echo" selected";?>><?echo$lang['tstatus']['away'];?></option>
<option value="na"<?if($_SESSION['status']=="na")echo" selected";?>><?echo$lang['tstatus']['na'];?></option>
<option value="dnd"<?if($_SESSION['status']=="dnd")echo" selected";?>><?echo$lang['tstatus']['dnd'];?></option>
</select>
</td>
</tr></form>
</table>

<table  style="width:100%;" width="100%" align="center" border="0" cellspacing="1" bgcolor="<?echo$color['tableh'];?>" cellpadding="1">
<tr>
<td  valign="middle" bgcolor="<?echo$color['tdbgcolor'];?>" style="padding:3px; font-size:10px; font-family:Tahoma; color:<?echo$color['tdcolor'];?>; virtual-align:middle; Text-decoration: none; height:16; Letter-spacing: 2px;" nowrap>
<a href="#" onselectstart="return false;" onclick="menu_right('rooms');">
<img id="img_rooms" src="theme/<?echo$skin;?>/img/st_d.gif" border="0" style="padding-right:5px;"><?echo$lang['rooms'];?>:</a>
</td>
</tr>
<tr id="rooms" style="display:none;">
<td valign="top" bgcolor="<?echo$color['bgcolor'];?>" style="font-size:<?echo$font;?>; color:<?echo$color['tdcolor'];?>;" align=center>
<form action="hidden.php" method=get target=hidden>
<input type="hidden" name="ch_room" value="1">
<select name="setroom" style="width:150px;font-size:8pt;">
<?
$query_rooms=mysql_query("select * from chat_rooms order by id");
while($array_rooms=mysql_fetch_array($query_rooms))
  {
  $total=mysql_num_rows(mysql_query("select * from chat_onliners where room='$array_rooms[id]'"));
  echo "<option value=\"$array_rooms[id]\"";
  if($_SESSION['room']==$array_rooms['id']) echo " selected";
  echo ">$array_rooms[name] ($total)</option>";
  }
?>
</select><br>
<button onclick="submit(); return false;"><?echo$lang['goto'];?></button>
</form></td>
</tr>
</td>
</tr>
</table>
<?
if($_SESSION['balls']>=500)
  {?>
<table  style="width:100%;" width="100%" align="center" border="0" cellspacing="1" bgcolor="<?echo$color['tableh'];?>" cellpadding="1">
<tr>
<td  valign="middle" bgcolor="<?echo$color['tdbgcolor'];?>" style="padding:3px; font-size:10px; font-family:Tahoma; color:<?echo$color['tdcolor'];?>; virtual-align:middle; Text-decoration: none; height:16; Letter-spacing: 2px;" nowrap>
<a href="#" onselectstart="return false;" onclick="menu_right('moder');">
<img id="img_moder" src="theme/<?echo$skin;?>/img/st_d.gif" border="0" style="padding-right:5px;"><?echo$lang['moder'];?>:</a>
</td>
</tr>
<tr id="moder" style="display:none;">
<td valign="top" bgcolor="<?echo$color['bgcolor'];?>" style="font-size:<?echo$font;?>; color:<?echo$color['tdcolor'];?>;" align=center>
[ <a href="#" onclick="adm_ban('','');"><b><?echo$lang['addban2'];?></b></a> ]<br>
[ <a href="#" onclick="ban_list();"><b><?echo$lang['banlist'];?></b></a> ]<br>
[ <a href="#" onclick="ban_logs();"><b><?echo$lang['banlogs'];?></b></a> ]
</td>
</tr>
</table><?
  }
?>
<table  style="width:100%;" width="100%" align="center" border="0" cellspacing="1" bgcolor="<?echo$color['tableh'];?>" cellpadding="1">
<tr>
<td  valign="middle" bgcolor="<?echo$color['tdbgcolor'];?>" style="padding:3px; font-size:10px; font-family:Tahoma; color:<?echo$color['tdcolor'];?>; virtual-align:middle; Text-decoration: none; height:16; Letter-spacing: 2px;" nowrap>
<a href="#" onselectstart="return false;" onclick="menu_right('other');">
<img id="img_other" src="theme/<?echo$skin;?>/img/st_d.gif" border="0" style="padding-right:5px;"><?echo$lang['addition'];?>:</a>
</td>
</tr>
<tr id="other" style="display:none;">
<td valign="top" bgcolor="<?echo$color['bgcolor'];?>" style="font-size:<?echo$font;?>; color:<?echo$color['tdcolor'];?>;" align=center>
[ <a href="#" onclick="window.open('rules.php','rules','width=700,height=450,top=0,left=0,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no');"><b><?echo$lang['rules'];?></b></a> ]<br>
[ <a href="#" onclick="window.parent.frames['hidden'].document.location.href='./blank.html'; window.parent.frames['messages'].document.getElementById('msgs').innerHTML='';"><b><?echo$lang['clearmess'];?></b></a> ]<br>
[ <a href="#" onclick="window.parent.frames['hidden'].document.location.href='./blank.html'; window.parent.frames['messages'].document.location.href='index.php?file=messages';"><b><?echo$lang['refmess'];?></b></a> ]<br>
[ <a href="#" onclick="window.open('ign.php?mode=myign','myignn','width=800,height=700,top=0,left=0,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no');"><b><?echo$lang['myignlist'];?></b></a> ]<br>
[ <a href="#" onclick="window.open('ign.php?mode=meign','meigns','width=530,height=700,top=0,left=0,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no');"><b><?echo$lang['meignlist'];?></b></a> ]<br>
</td>
</tr>
</table>

<table  style="width:100%;" width="100%" align="center" border="0" cellspacing="1" bgcolor="<?echo$color['tableh'];?>" cellpadding="1">
<tr>
<td  valign="middle" bgcolor="<?echo$color['tdbgcolor'];?>" style="padding:3px; font-size:10px; font-family:Tahoma; color:<?echo$color['tdcolor'];?>; virtual-align:middle; Text-decoration: none; height:16; Letter-spacing: 2px;" nowrap>
<a href="#" onselectstart="return false;" onclick="menu_right('smiles');">
<img id="img_smiles" src="theme/<?echo$skin;?>/img/st_d.gif" border="0" style="padding-right:5px;"><?echo$lang['smiles'];?>:</a>
</td>
</tr>
<tr id="smiles" style="display:none;">
<td valign="top" bgcolor="<?echo$color['bgcolor'];?>" style="font-size:<?echo$font;?>; color:<?echo$color['tdcolor'];?>;" align=center>
<table border=0 align=center width=100%><tr>
<?
$query_sm=mysql_query("select * from chat_smiles group by url");
$q=0;
while($array_sm=mysql_fetch_array($query_sm))
  {
  if($q%3==0 && $q!=0)
    {
    echo '</tr><tr>';
    }
  echo "<td align=\"center\"><a href=\"javascript:insSmile('$array_sm[code]');\"><img src=\"smiles/$array_sm[url]\" border=0></a></td>";
  $q++;
  }
?>
</tr>
</table></td>
</tr>
</table>

<table  style="width:100%;" width="100%" align="center" border="0" cellspacing="1" bgcolor="<?echo$color['tableh'];?>" cellpadding="1">
<tr>
<td  valign="middle" bgcolor="<?echo$color['tdbgcolor'];?>" style="padding:3px; font-size:10px; font-family:Tahoma; color:<?echo$color['tdcolor'];?>; virtual-align:middle; Text-decoration: none; height:16; Letter-spacing: 2px;" nowrap>
<a href="#" onselectstart="return false;" onclick="menu_right('opts');">
<img id="img_opts" src="theme/<?echo$skin;?>/img/st_d.gif" border="0" style="padding-right:5px;"><?echo$lang['option'];?>:</a>
</td>
</tr>
<tr id="opts" style="display:none;">
<td valign="top" bgcolor="<?echo$color['bgcolor'];?>" style="font-size:<?echo$font;?>; color:<?echo$color['tdcolor'];?>;" align=center>
[ <a href="#" onclick="window.open('userinfo.php?mode=edit','myinfo','width=800,height=750,top=0,left=0,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no');"><b><?echo$lang['myinfo'];?></b></a> ]<br>
<?
if($_SESSION['balls']>=700)
  {
  echo "[ <a href=\"adm.php\" target=_blank><b>$lang[conpanel]</b></a> ]";
  }
?>
<form action="hidden.php" method=get target=hidden>
<input type="hidden" name="ch_opts" value="1">
<div align="left">
<b><?echo$lang['smiles'];?>:</b> 
<input name="setsmiles" type="checkbox" value=1 <?if($_SESSION['smiles']==1)echo" checked";?>><br>
<b><?echo$lang['newmess'];?>:</b><br> 
<input name="setnm" value="up" type="radio"<?if($_SESSION['nm']=="up")echo" checked";?>><?echo$lang['ups'];?>&nbsp;&nbsp;
<input name="setnm" value="down" type="radio"<?if($_SESSION['nm']=="down")echo" checked";?>><?echo$lang['downs'];?><br>
<b><?echo$lang['sendform'];?>:</b><br> <input name="setsend" value="up" type="radio"<?if($_SESSION['send']=="up")echo" checked";?>><?echo$lang['ups'];?>&nbsp;&nbsp;
<input name="setsend" value="down" type="radio"<?if($_SESSION['send']=="down")echo" checked";?>><?echo$lang['downs'];?><br>
<b><?echo$lang['autofocus'];?>:</b><br> <input name="setfocus" value="1" type="radio"<?if($_SESSION['focus']=="1") echo" checked";?>><?echo$lang['ups'];?>&nbsp;&nbsp;
<input name="setfocus" value="0" type="radio"<?if($_SESSION['focus']=="0")echo" checked";?>><?echo$lang['off'];?><br>
<b><?echo$lang['theme'];?>:</b>
<select name=setskin>
<?
define("SK_MOD",1);
include("theme/skins.php");
foreach($skins as $val)
  {
  echo "<option";
  if($_SESSION['skin']==$val) echo" selected";
  echo ">$val</option>";
  }
?>
</select><br>
<b><?echo$lang['language'];?>:</b>
<select name=setlang>
<?
$query_langs=mysql_query("select lang from chat_language group by lang");
while($arr_langs=mysql_fetch_array($query_langs))
  {
  echo "<option";
  if($_SESSION['slang']==$arr_langs['lang']) echo" selected";
  echo ">$arr_langs[lang]</option>";
  }
?>
</select><br>
<b><?echo$lang['time'];?>:</b> 
<select name="settime">
<option value="hm"<?if($_SESSION['vtime']=="hm")echo" selected";?>><?echo$lang['ttime']['hm'];?>
<option value="hms"<?if($_SESSION['vtime']=="hms")echo" selected";?>><?echo$lang['ttime']['hms'];?>
<option value="ms"<?if($_SESSION['vtime']=="ms")echo" selected";?>><?echo$lang['ttime']['ms'];?>
</select><br></div>
<button onclick="submit(); return false;"><?echo$lang['apply'];?></button>
</form>
</td>
</tr>
</table>

<table  style="width:100%;" width="100%" align="center" border="0" cellspacing="1" bgcolor="<?echo$color['tableh'];?>" cellpadding="1">
<tr>
<td  valign="middle" bgcolor="<?echo$color['tdbgcolor'];?>" style="padding:3px; font-size:10px; font-family:Tahoma; color:<?echo$color['tdcolor'];?>; virtual-align:middle; Text-decoration: none; height:16; Letter-spacing: 2px;" nowrap>
<a href="#" onselectstart="return false;" onclick="menu_right('mail');">
<img id="img_mail" src="theme/<?echo$skin;?>/img/st_d.gif" border="0" style="padding-right:5px;"><?echo$lang['mail'];?>:</a>
</td>
</tr>
<tr id="mail" style="display:none;">
<td valign="top" bgcolor="<?echo$color['bgcolor'];?>" style="font-size:<?echo$font;?>; color:<?echo$color['tdcolor'];?>;" align=center>
<?
$nums_in=mysql_result(mysql_query("select count(id) from chat_mail where userto='$_SESSION[suser]' and viewin=1"),0,'count(id)');
$nums_innew=mysql_result(mysql_query("select count(id) from chat_mail where userto='$_SESSION[suser]' and rd='0' and viewin=1"),0,'count(id)');
$nums_out=mysql_result(mysql_query("select count(id) from chat_mail where user='$_SESSION[suser]' and viewout=1"),0,'count(id)');
$procs=round(($nums_in+$nums_out)/$max_msgs*100,1);
?><b>
[ <a href="#" onclick="window.open('mail.php?mode=in','mail_in','width=800,height=700,top=0,left=0,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no');"><?echo$lang['inbox'];?></a> <?echo$nums_in;if($nums_innew>0)echo" ($nums_innew)";?> ]<br>
[ <a href="#" onclick="window.open('mail.php?mode=out','mail_out','width=800,height=700,top=0,left=0,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no');"><?echo$lang['outbox'];?></a> <?echo$nums_out;?> ]<br>
[ <?echo$lang['usemail'];?>: <?echo$procs;?>% ]<br>
[ <a href="#" onclick="window.open('mail.php?mode=write','mail_new','width=800,height=750,top=0,left=0,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no');"><?echo$lang['newletter'];?></a> ]</b>
</td>
</tr>
</table>
</body>
</html>