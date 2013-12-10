<?
define("C_MOD",1);
include("inc/functions.php");

if(empty($act)) $act="";

if($act=="add")
  {
  if(empty($content)) $error=1;
  if(empty($compl_user)) $error=1;
  if(empty($error))
    {
    @$balls_us=mysql_result(mysql_query("select balls from chat_users where user='".mysql_escape_string(urldecode($compl_user))."'"),0,'balls');
    if($_SESSION['suser']!=$compl_user&&$balls_us>=500&&$balls_us>=$_SESSION['balls'])
      {
      $content=substr($content,0,60);
      $time=time();
      mysql_query("insert into chat_compl (user,moder,time,text) values ('$_SESSION[suser]','$compl_user','$time','$content');") or die(mysql_error());
      mysql_query("insert into chat_messages (room, user, userto, message, private, color, time) values ('$_SESSION[room]','$bot_name','$_SESSION[suser]','Вы добавили жалобу на модератора $compl_user. Администрация примет его к сведению','1','#ff0000','$time');") or die(mysql_error());
      }
    ?><html><head></head><body><script language=javascript>window.close();</script></body></html><?
    }
  }
else
  {?>
  <html>
  <head><title><?echo$lang['addcompl'];?></title>
  <meta http-equiv="content-type" Content="text/html;charset=windows-1251">
  <script language="JavaScript">
  <!--
  window.moveTo((screen.width-530)/2 , ((screen.height-302)/2)-100);
  //-->
  </script>
  <style>
  .small {Font-Family: Tahoma, Arial;Font-size: 11px;}
  </style>
  </head>
  <body>
  <table cellpadding="2" cellspacing="2" border="0" width=100%>
  <form name='form' action='compl.php' method='post'>
  <input type="hidden" name="act" value="add">
  <input type="hidden" name="compl_user" value="<?echo urldecode($login);?>">
  <tr valign="top">
  <td align="right" width=30%><b><?echo$lang['addcompl'];?>:</b></td>
  <td width=70%><?echo urldecode($login);?></td>
  </tr>
  <tr valign="top">
  <td align="right"><b><?echo$lang['text2'];?>:</b></td>
  <td><textarea style="width:100%" rows=10 name=content maxlength=60></textarea></td>
  </tr>
  <tr valign="top">
  <td></td>
  <td align="right"><input value="<?echo$lang['addcompl'];?>" type="submit">&nbsp;<input name="exit" onclick="window.close();" value="<?echo$lang['cancel'];?>" type="button"></td>
  </tr>
  </table><?
  }
?>