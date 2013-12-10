<?
### setcountsm ###
if(preg_match("#^/setcountsm[\s]+([0-9]+)$#is",$message,$cons))
  {
  mysql_query("update chat_config set value='$cons[1]' where name='max_sm'");
  mysql_query("insert into chat_messages (room, user, userto, message, private, time) values ('$_SESSION[room]','$bot_name','$_SESSION[suser]','Параметр \"Кол-во максимально допустимых смайлов в сообщении\" успешно изменён. Значение: $cons[1]','1','$time');") or die(mysql_error());
  $nomsg=1;
  }
elseif(preg_match("#^/setkick[\s]+([0-9]+)$#is",$message,$cons))
  {
  mysql_query("update chat_config set value='$cons[1]' where name='user_prunetime'");
  mysql_query("insert into chat_messages (room, user, userto, message, private, time) values ('$_SESSION[room]','$bot_name','$_SESSION[suser]','Параметр \"Кол-во секунд, после которых юзер кикается\" успешно изменён. Значение: $cons[1]','1','$time');") or die(mysql_error());
  $nomsg=1;
  }
elseif(preg_match("|^/setcountmsgs[\s]+([0-9]+)$|is",$message,$cons))
  {
  mysql_query("update chat_config set value='$cons[1]' where name='savemsgcount'");
  mysql_query("insert into chat_messages (room, user, userto, message, private, time) values ('$_SESSION[room]','$bot_name','$_SESSION[suser]','Параметр \"Кол-во хранимых в БД сообщений (для каждой комнаты)\" успешно изменён. Значение: $cons[1]','1','$time');") or die(mysql_error());
  $nomsg=1;
  }
elseif(preg_match("|^/setwidthmax[\s]+([0-9]+)$|is",$message,$cons))
  {
  mysql_query("update chat_config set value='$cons[1]' where name='widthmax'");
  mysql_query("insert into chat_messages (room, user, userto, message, private, time) values ('$_SESSION[room]','$bot_name','$_SESSION[suser]','Параметр \"Максимальная ширина загружаемой пользовательской фотографии\" успешно изменён. Значение: $cons[1]','1','$time');") or die(mysql_error());
  $nomsg=1;
  }
elseif(preg_match("|^/setheightmax[\s]+([0-9]+)$|is",$message,$cons))
  {
  mysql_query("update chat_config set value='$cons[1]' where name='heightmax'");
  mysql_query("insert into chat_messages (room, user, userto, message, private, time) values ('$_SESSION[room]','$bot_name','$_SESSION[suser]','Параметр \"Максимальная высота загружаемой пользовательской фотографии\" успешно изменён. Значение: $cons[1]','1','$time');") or die(mysql_error());
  $nomsg=1;
  }
elseif(preg_match("|^/setsizemax[\s]+([0-9]+)$|is",$message,$cons))
  {
  mysql_query("update chat_config set value='$cons[1]' where name='sizemax'");
  mysql_query("insert into chat_messages (room, user, userto, message, private, time) values ('$_SESSION[room]','$bot_name','$_SESSION[suser]','Параметр \"Максимальный размер загружаемой пользовательской фотографии\" успешно изменён. Значение: $cons[1]','1','$time');") or die(mysql_error());
  $nomsg=1;
  }
elseif(preg_match("|^/setmailmsgs[\s]+([0-9]+)$|is",$message,$cons))
  {
  mysql_query("update chat_config set value='$cons[1]' where name='max_msgs'");
  mysql_query("insert into chat_messages (room, user, userto, message, private, time) values ('$_SESSION[room]','$bot_name','$_SESSION[suser]','Параметр \"Максимальное кол-во хранимых сообщений в личке\" успешно изменён. Значение: $cons[1]','1','$time');") or die(mysql_error());
  $nomsg=1;
  }
elseif(preg_match("|^/setdayslogs[\s]+([0-9]+)$|is",$message,$cons))
  {
  mysql_query("update chat_config set value='$cons[1]' where name='clear_logs'");
  mysql_query("insert into chat_messages (room, user, userto, message, private, time) values ('$_SESSION[room]','$bot_name','$_SESSION[suser]','Параметр \"Кол-во дней, за которые хранятся логи банов\" успешно изменён. Значение: $cons[1]','1','$time');") or die(mysql_error());
  $nomsg=1;
  }
elseif(preg_match("|^/setdayscompl[\s]+([0-9]+)$|is",$message,$cons))
  {
  mysql_query("update chat_config set value='$cons[1]' where name='clear_compl'");
  mysql_query("insert into chat_messages (room, user, userto, message, private, time) values ('$_SESSION[room]','$bot_name','$_SESSION[suser]','Параметр \"Кол-во дней, за которые хранятся жалобы на модеров\" успешно изменён. Значение: $cons[1]','1','$time');") or die(mysql_error());
  $nomsg=1;
  }
elseif(preg_match("#^/setbotname[\s]+([\w]+)$#is",$message,$cons))
  {
  mysql_query("update chat_rooms set botname='$cons[1]' where id='$_SESSION[room]'");
  mysql_query("insert into chat_messages (room, user, userto, message, private, time) values ('$_SESSION[room]','$bot_name','$_SESSION[suser]','Новый бот этой комнаты: $cons[1]','1','$time');") or die(mysql_error());
  $nomsg=1;
  }
elseif(preg_match("#^/setroomname[\s]+([\w]+)$#is",$message,$cons))
  {
  mysql_query("update chat_rooms set name='$cons[1]' where id='$_SESSION[room]'");
  mysql_query("insert into chat_messages (room, user, userto, message, private, time) values ('$_SESSION[room]','$bot_name','$_SESSION[suser]','Новое название этой комнаты: $cons[1]','1','$time');") or die(mysql_error());
  $nomsg=1;
  }
elseif(preg_match("|^/setballs[\s]+-n[\s]+([a-zA-Z0-9_]+)[\s]+-b[\s]+([0-9]{1,3})$|is",$message,$cons))
  {
  $time=time();
  if(strtolower($cons[1])!=strtolower($_SESSION['suser']))
    {
    mysql_query("update chat_users set balls='$cons[2]' where user='$cons[1]'");
    mysql_query("update chat_onliners set balls='$cons[2]' where user='$cons[1]'");
    mysql_query("update chat_onliners set upd='$time'");
    mysql_query("insert into chat_messages (room, user, userto, message, private, time) values ('$_SESSION[room]','$bot_name','$_SESSION[suser]','Участнику $cons[1] назначены баллы: $cons[2]','1','$time');") or die(mysql_error());
    }
  else
    mysql_query("insert into chat_messages (room, user, userto, message, private, time) values ('$_SESSION[room]','$bot_name','$_SESSION[suser]','Вы решили снять с себя администраторские полномочия? Одумайтесь!..или используйте панель администрирования','1','$time');") or die(mysql_error());
  $nomsg=1;
  }
#$str3="/clearlogs -s 20-12-2005 -f 1-9-2006";
elseif(preg_match("#^/clearlogs([\s]+-s[\s]+([0-9]{1,2})-([0-9]{1,2})-([0-9]{4})([\s]+-f[\s]+([0-9]{1,2})-([0-9]{1,2})-([0-9]{4}))*)*$#is",$message,$cons))
  {
  if(empty($cons[5]) || (empty($cons[6]) || empty($cons[7]) || empty($cons[8]))) list($cons[6],$cons[7],$cons[8])=explode("-",date("d-m-Y"));
  $arr30=array(4,6,9,11);
  if(in_array($cons[3],$arr30)&&$cons[2]==31) $cons[2]=30;
  elseif($cons[3]==2&&$$cons[2]>28) $d_s=28;
  if(in_array($cons[7],$arr30)&&$cons[6]==31) $cons[6]=30;
  elseif($cons[7]==2&&$cons[6]>28) $cons[6]=28;
  $time_s=mktime(0,0,0,$cons[3],$cons[2],$cons[4]);
  $time_f=mktime(0,0,0,$cons[7],$cons[6],$cons[8]);
  mysql_query("delete from chat_logs where time>='$time_s' and time<='$time_f'");
  mysql_query("insert into chat_messages (room, user, userto, message, private, time) values ('$_SESSION[room]','$bot_name','$_SESSION[suser]','Логи с ".dbdate("$cons[4]-$cons[3]-$cons[2]")." по ".dbdate("$cons[8]-$cons[7]-$cons[6]")." очищены','1','$time');") or die(mysql_error());
  $nomsg=1;
  }
elseif(preg_match("|^/clearcompls([\s]+-s[\s]+([0-9]{1,2})-([0-9]{1,2})-([0-9]{4})([\s]+-f[\s]+([0-9]{1,2})-([0-9]{1,2})-([0-9]{4}))*)*$|is",$message,$cons))
  {
  if(empty($cons[5]) || (empty($cons[6]) || empty($cons[7]) || empty($cons[8]))) list($cons[6],$cons[7],$cons[8])=explode("-",date("d-m-Y"));
  $arr30=array(4,6,9,11);
  if(in_array($cons[3],$arr30)&&$cons[2]==31) $cons[2]=30;
  elseif($cons[3]==2&&$$cons[2]>28) $d_s=28;
  if(in_array($cons[7],$arr30)&&$cons[6]==31) $cons[6]=30;
  elseif($cons[7]==2&&$cons[6]>28) $cons[6]=28;
  $time_s=mktime(0,0,0,$cons[3],$cons[2],$cons[4]);
  $time_f=mktime(0,0,0,$cons[7],$cons[6],$cons[8]);
  mysql_query("delete from chat_compl where time>='$time_s' and time<='$time_f'");
  mysql_query("insert into chat_messages (room, user, userto, message, private, time) values ('$_SESSION[room]','$bot_name','$_SESSION[suser]','Жалобы с ".dbdate("$cons[4]-$cons[3]-$cons[2]")." по ".dbdate("$cons[8]-$cons[7]-$cons[6]")." очищены','1','$time');") or die(mysql_error());
  $nomsg=1;
  }

?>