<?
define("C_MOD",1);
define("F_MOD",1);
include("inc/functions.php");
$sess_id=session_id();
if(empty($file)) $file="";
$chat_refreshtime*=1000;

if(empty($resultcnt)) $resultcnt=0;
if(!empty($_SESSION['suser']))
  {
  $checkauth=mysql_query("select sid from chat_onliners where user='$_SESSION[suser]' and sid='$sess_id'");
  $resultcnt=mysql_num_rows($checkauth);
  }

if(isset($_SESSION['suser'])&&$resultcnt==1)
  {
  include("theme/$skin/colors.php");
  if($file=="header")
    {
    include("files/header.php");
    }
  if($file=="messages")
    {
    include("files/messages.php");
    }
  elseif($file=="users")
    {
    include("files/users.php");
    }
  elseif($file=="send")
    {
    include("files/send.php");
    }
  else
    {
    include("files/main.php");
    }
  }
elseif($_SERVER['QUERY_STRING']=="reg"&&empty($_SESSION['suser']))
  {
  include("files/reg.php");
  }
elseif($_SERVER['QUERY_STRING']=="forg"&&empty($_SESSION['suser']))
  {
  include("files/forg.php");
  }
else
  {
  if(empty($room)) $room=mysql_result(mysql_query("select min(id) from chat_rooms"),0,'min(id)');?>
<html>
<head>
<title><?echo$chat_title;?></title>
<META HTTP-EQUIV="Content-Type" Content="text/html;Charset=Windows-1251">
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
<tr valign="middle">
<td width="60%" align="right">
<table cellpadding="3" cellspacing="2" border="0" style="Border-color:#BABABA; Border-style: solid; Border-width: 1px;">
<form action="auth.php" method="post" name="form">
<tr><td bgcolor="#DADADA" colspan="2" align="center"><b>Авторизация</b></td></tr>
<tr>
<td style="text-align:right;width:70;">Имя:</td>
<td style="text-align:left;"><input type="text" maxlength="32" value="" style="width:250" name="login"></td>
</tr>
<tr>
<td style="text-align:right;width:70;">Пароль:</td>
<td style="text-align:left;"><input type="password" maxlength="32" value="" style="width:250" name="pass"></td>
</tr>
<tr>
<td style="text-align:right;width:70;" valign="top">Комната:</td>
<td style="text-align:left;">
<select name="room" style="width:250" onChange="self.location='index.php?room='+form.room.value"><?
$query_rooms=mysql_query("select * from chat_rooms order by id");
while($array_rooms=mysql_fetch_array($query_rooms))
  {
  $total=mysql_num_rows(mysql_query("select * from chat_onliners where room='$array_rooms[id]'"));
  echo "<option value=\"$array_rooms[id]\"";
  if($room==$array_rooms['id']) echo " selected";
  echo ">$array_rooms[name] ($total)</option>";
  }?>
</select></td>
</tr>
<tr>
<td style="text-align:right;width:70;"></td><td style="text-align:right;">
<input type="submit" value="Авторизироваться" name="submit"></td>
</tr>
</form>
</table>
[ <a href="#" onclick='window.open("index.php?reg","_blank","Width=800,Height=500,toolbar=0,status=0,border=0,scrollbars=0");'>Регистрация</a> ]
[ <a href=# onclick='window.open("index.php?forg","_blank","Width=600,Height=200,toolbar=0,status=0,border=0,scrollbars=0");'>Восстановить пароль</a> ]
</td>
<td width="40%" nowrap align="center">
<table width="200" cellpadding="3" cellspacing="2" border="0" style="Border-color:#BABABA; Border-style: solid; Border-width: 1px;">
<tr>
<td bgcolor="#DADADA" align="center"><b>Сейчас в чате:</b></td>
</tr><?
$query_us=mysql_query("select user from chat_onliners where room='$room'");
if(mysql_num_rows($query_us)==0) echo "<tr><td align=center>пусто</td></tr>";
else
while($array_us=mysql_fetch_array($query_us))
  echo "<tr><td align=center>$array_us[user]</td></tr>";?>
</form>
</table>
</td>
</tr> 
</table>
</html><?
  }
?>