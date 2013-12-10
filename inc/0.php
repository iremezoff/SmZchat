<?
define("SK_MOD",1);
include("theme/skins.php");
$skns=implode("|",$skins);
$skns=substr($skns,0,strlen($skns)-1);
if($message=="/clearmsgs")
  {?>
  <script language=javascript>
  <!--
  window.parent.frames['hidden'].document.location.href='./blank.html'; 
  window.parent.frames['messages'].document.getElementById('msgs').innerHTML='';
  //-->
  </script>
  <?
  $nomsg=1;
  }
elseif($message=="/refmsgs")
  {?>
  <script language=javascript>
  <!--
  window.parent.frames['hidden'].document.location.href='./blank.html'; 
  window.parent.frames['messages'].document.location.href='index.php?file=messages';
  //-->
  </script>
  <?
  $nomsg=1;
  }
elseif(preg_match("#^/ign[\s]+([a-z0-9_]+)$#is",$message,$cons))
  {?>
  <script language=javascript>
  <!--
  document.write('<?echo$cons[1];?>');
  window.parent.frames['hidden'].location.href='hidden.php?ignore=<?echo$cons[1];?>';
  //-->
  </script>
  <?
  $nomsg=1;
  }
elseif(preg_match("#^/unign[\s]+([a-z0-9_]+)$#is",$message,$cons))
  {?>
  <script language=javascript>
  <!--
  window.parent.frames['hidden'].location.href='hidden.php?unignore=<?echo$cons[1];?>';
  //-->
  </script>
  <?
  $nomsg=1;
  }
elseif($message=="/myigns")
  {
  $msg="Список игнорируемых: <br><table border=1 bordercolor=#000000><tr><td align=center><b>Юзер</b></td><td align=center><b>IP</b></td></tr>";
  $query_ign=mysql_query("select ignores from chat_ignore where user='$_SESSION[suser]' order by id desc");
  while($array_ign=mysql_fetch_array($query_ign))
    $msg.="<tr><td>$array_ign[ignores]</td></tr>";
  $msg.="</table>";
  $is_private=1;
  $sendername=$bot_name;
  $senderto=$_SESSION['suser'];
  }
elseif($message=="/meigns")
  {
  $msg="Список игнорирующих: <br><table border=1 bordercolor=#000000><tr><td align=center><b>Юзер</b></td><td align=center><b>IP</b></td></tr>";
  $query_ign=mysql_query("select user from chat_ignore where ignores='$_SESSION[suser]' order by id desc") or die(mysql_error());
  while($array_ign=mysql_fetch_array($query_ign))
    $msg.="<tr><td>$array_ign[ignores]</td></tr>";
  $msg.="</table>";
  $is_private=1;
  $sendername=$bot_name;
  $senderto=$_SESSION['suser'];
  }
elseif(preg_match("#^/setroom[\s]+([\w]+)$#is",$message,$cons))
  {
  @$nroom=mysql_result(mysql_query("select id from chat_rooms where name='$cons[1]'"),0,'id');
  if($nroom && $_SESSION['room']!=$nroom)
    {
    $time=time();
    $check=mysql_num_rows(mysql_query("select id from chat_rooms where id='$setroom'"));
    if($check<1)
      $setroom=mysql_result(mysql_query("select min(id) from chat_rooms"),0,'min(id)');
    $room_name=mysql_result(mysql_query("select name from chat_rooms where id='$nroom'"),0,'name');
    $rooml_name=mysql_result(mysql_query("select name from chat_rooms where id='$_SESSION[room]'"),0,'name');
    $bot_name2=mysql_result(mysql_query("select botname from chat_rooms where id='$nroom'"),0,'botname');
    mysql_query("update chat_onliners set room='$setroom',upd='$time' where user='$_SESSION[suser]'");
    mysql_query("insert into chat_messages (room,user,message,time) values ('$_SESSION[room]','$bot_name','Участник <b>$_SESSION[suser]</b> сбежал в комнату <b>$room_name</b>.','$time'), ('$setroom','$bot_name2','Участник <b>$_SESSION[suser]</b> прибежал из комнаты <b>$rooml_name</b>.','$time')");
    $_SESSION['room']=$nroom;
    $nomsg=1;
    ?><script language=javascript>parent.document.location.href='index.php';</script><?
    }
  }
elseif($message=="/logout")
  {
  $nomsg=1;
  ?><script language=javascript>parent.document.location.href='auth.php?mode=exit';</script><?
  }
elseif(preg_match("#^/setstatus[\s]+(free|dnd|na|away)+$#is",$message,$cons))
  {
  $time=time();
  $_SESSION['status']=$cons[1];
  mysql_query("update chat_onliners set status='$cons[1]',upd='$time' where user='".addslashes($_SESSION['suser'])."'");
  $nomsg=1;
  ?><script language=javascript>parent.document.location.href='index.php';</script><?
  }
elseif(preg_match("#^/setskin[\s]+($skns)+$#is",$message,$cons))
  {
  echo $skns;
  $time=time();
  $_SESSION['skin']=$cons[1];
  mysql_query("update chat_onliners set status='$cons[1]',upd='$time' where user='".addslashes($_SESSION['suser'])."'");
  mysql_query("update chat_users set skin='$_SESSION[skin]' where user='".addslashes($_SESSION['suser'])."'") or die(mysql_error());
  $nomsg=1;
  ?><script language=javascript>parent.document.location.href='index.php';</script><?
  }
elseif(preg_match("#^/settime[\s]+(hm|hms|ms)+$#is",$message,$cons))
  {
  $time=time();
  $_SESSION['vtime']=$cons[1];
  mysql_query("update chat_users set time='$_SESSION[vtime]' where user='".addslashes($_SESSION['suser'])."'") or die(mysql_error());
  $nomsg=1;
  ?><script language=javascript>parent.document.location.href='index.php';</script><?
  }
elseif(preg_match("#^/setsend[\s]+(up|down)+$#is",$message,$cons))
  {
  $time=time();
  $_SESSION['send']=$cons[1];
  mysql_query("update chat_users set send='$_SESSION[send]' where user='".addslashes($_SESSION['suser'])."'") or die(mysql_error());
  $nomsg=1;
  ?><script language=javascript>parent.document.location.href='index.php';</script><?
  }
elseif(preg_match("#^/setmsgs[\s]+(up|down)+$#is",$message,$cons))
  {
  $time=time();
  $_SESSION['nm']=$cons[1];
  mysql_query("update chat_users set nm='$_SESSION[nm]' where user='".addslashes($_SESSION['suser'])."'") or die(mysql_error());
  $nomsg=1;
  ?><script language=javascript>parent.document.location.href='index.php';</script><?
  }
elseif(preg_match("#^/setsmile[\s]+(on|off)+$#is",$message,$cons))
  {
  $time=time();
  $_SESSION['smiles']=$cons[1];
  mysql_query("update chat_users set smiles='$_SESSION[smiles]' where user='".addslashes($_SESSION['suser'])."'") or die(mysql_error());
  $nomsg=1;
  ?><script language=javascript>parent.document.location.href='index.php';</script><?
  }
elseif(preg_match("#^/setmail[\s]+([a-z0-9_]+(([a-z0-9_.-]+)?)@[a-z0-9+](([a-z0-9_.-]+)?)+\.+[a-z]{2,4})+$#is",$message,$cons))
  {
  $_SESSION['smail']=$cons[1];
  mysql_query("update chat_users set mail='$cons[1]' where user='".addslashes($_SESSION['suser'])."'") or die(mysql_error());
  mysql_query("insert into chat_messages (room, user, userto, message, private, color, time) values ('$_SESSION[room]','$bot_name','$_SESSION[suser]','E-mail успешно изменён. E-mail: $cons[1]','1','#ff0000','$time');") or die(mysql_error());
  $nomsg=1;
  }
elseif(preg_match("#^/hidemail[\s]+(on|off)+$#is",$message,$cons))
  {
  if($cons[1]=="on") $hide=1;
  else $hide=0;
  mysql_query("update chat_users set hidemail='$hide' where user='".addslashes($_SESSION['suser'])."'") or die(mysql_error());
  mysql_query("insert into chat_messages (room, user, userto, message, private, color, time) values ('$_SESSION[room]','$bot_name','$_SESSION[suser]','Парметр скрытия e-mail изменён. Значение: $cons[1]','1','#ff0000','$time');") or die(mysql_error());
  $nomsg=1;
  }
elseif(preg_match("#^/setabout[\s]+(.+)$#is",$message,$cons))
  {
  mysql_query("update chat_users set about='$cons[1]' where user='".addslashes($_SESSION['suser'])."'") or die(mysql_error());
  mysql_query("insert into chat_messages (room, user, userto, message, private, color, time) values ('$_SESSION[room]','$bot_name','$_SESSION[suser]','Информация успешно изменена. Значение: $cons[1]','1','#ff0000','$time');") or die(mysql_error());
  $nomsg=1;
  }
elseif(preg_match("|^/addcompl[\s]+-n[\s]+([a-z0-9_]+)[\s]+-m[\s]+(.+)$|is",$msg,$cons))
  {
  echo "1";
  @$balls_us=mysql_result(mysql_query("select balls from chat_users where user='".mysql_escape_string($cons[1])."'"),0,'balls');
  echo $balls_us;
  if(strtolower($_SESSION['suser'])!=strtolower($cons[2]) && $balls_us>=500 && $balls_us>=$_SESSION['balls'])
    {
    $time=time();
    mysql_query("insert into chat_compl (user,moder,time,text) values ('$_SESSION[suser]','$cons[1]','$time','$cons[2]');") or die(mysql_error());
    mysql_query("insert into chat_messages (room, user, userto, message, private, color, time) values ('$_SESSION[room]','$bot_name','$_SESSION[suser]','Вы добавили жалобу на модератора $cons[1]. Администрация примет его к сведению','1','#ff0000','$time');") or die(mysql_error());
    }
  $nomsg=1;
  }
elseif(preg_match("#^/setpass[\s]+-l[\s]+([a-z0-9_.-]+)[\s]+-n[\s]+([a-z0-9_.-]+)[\s]+-c[\s]+([a-z0-9_.-]+)[\s]*$#is",$message,$cons))
  {
  $mess="";
  $ltpass=mysql_result(mysql_query("select pass from chat_users where user='".strtolower($_SESSION['suser'])."'"),0,'pass');
  if(empty($cons[1])) $mess=$lang['error']['oldpass'];
  elseif($ltpass!=md5($cons[1])) $mess=$lang['error']['oldpass2'];
  elseif($cons[2]!=$cons[3]) $mess=$lang['error']['passes'];
  if(empty($mess))
    {
    $cons[2]=md5($cons[2]);
    mysql_query("update chat_users set pass='$cons[2]' where user='$_SESSION[suser]'");
    mysql_query("insert into chat_messages (room, user, userto, message, private, color, time) values ('$_SESSION[room]','$bot_name','$_SESSION[suser]','Пароль успешно изменён','1','#ff0000','$time');") or die(mysql_error());
    }
  else
    mysql_query("insert into chat_messages (room, user, userto, message, private, color, time) values ('$_SESSION[room]','$bot_name','$_SESSION[suser]','$mess','1','#ff0000','$time');") or die(mysql_error());
  $nomsg=1;
  }
elseif(preg_match("#^/setpass#is",$message))
  {
  $nomsg=1;
  }
else echo "NO!";
?>