<?
#####################
### FOR MODERS ######
#####################


if(substr_count($msg,"/beg ")>0) $msg="<br><marquee>".str_replace("/beg","",$msg)."</marquee>";
elseif(substr_count($msg,"/ips")>0) 
  {
  $msg="<br><table border=1 bordercolor=#000000><tr><td align=center><b>ёзер</b></td><td align=center><b>IP</b></td></tr>";
  $query_ol=mysql_query("select user,ip from chat_onliners where room='$_SESSION[room]' order by ip");
  while($array_ol=mysql_fetch_array($query_ol))
    $msg.="<tr><td>$array_ol[user]</td><td>$array_ol[ip]</td></tr>";
  $msg.="</table>";
  $is_private=1;
  $sendername=$bot_name;
  $senderto=$_SESSION['suser'];
  }
elseif(substr_count($msg,"/users")>0) 
  {
  $msg="<br><table border=1 bordercolor=#000000><tr>
  <td align=center><b>ёзер</b></td>
  <td align=center><b>IP</b></td>
  <td align=center><b>Ѕаллы</b></td>
  <td align=center><b>язык</b></td>
  <td align=center><b>—татус</b></td></tr>";
  $query_ol=mysql_query("select user,ip,balls,lang,status from chat_onliners where room='$_SESSION[room]' order by ip");
  while($array_ol=mysql_fetch_array($query_ol))
    $msg.="<tr><td>$array_ol[user]</td><td>$array_ol[ip]</td><td>$array_ol[balls]</td><td>$array_ol[lang]</td><td>$array_ol[status]</td></tr>";
  $msg.="</table>";
  $is_private=1;
  $sendername=$bot_name;
  $senderto=$_SESSION['suser'];
  }

### ban ###
elseif(preg_match("|^/ban[\s]+-n[\s]+([a-zA-Z0-9_]+)|is",$msg,$aban[]))
  {
  $error=0;
  $ban_l=$aban[0][1];
  if(preg_match("|[\s]+-t[\s]+([0-9]+)|is",$msg,$aban[])) $ban_time=$aban[1][1]*60;
  else $error=1;
  if(preg_match("|[\s]+-r[\s]+([0-9]+)|is",$msg,$aban[])) $reson=$aban[2][1];
  else $error=1;
  if(preg_match("|[\s]+-p[\s]+([0-9]+)|is",$msg,$aban[])) $type=$aban[3][1];
  else $error=1;
  if(preg_match("|[\s]+-i[\s]+(([0-9]{1,3}).([0-9]{1,3}).([0-9]{1,3}).([0-9]{1,3}))+|is",$msg,$aban[])&&$aban[4][2]<=255&&$aban[4][3]<=255&&$aban[4][4]<=255&&$aban[4][5]<=255) $ban_ip=$aban[4][1];
  else $ban_ip="";

  if($error!=1)
    {
    $time=time();
    $balls_us=mysql_result(mysql_query("select balls from chat_users where user='".urldecode($ban_l)."'"),0,'balls');
    if($_SESSION['balls']>=$balls_us)
      {
      $getbans=mysql_query("select mute_settime from chat_banlist where user='".urldecode($ban_l)."'");
      $bans=mysql_num_rows($getbans);
      if($bans>0)
        {
        mysql_query("insert into chat_banlist values (set user='$ban_l',ip='$ban_ip',ban='$_SESSION[suser]',type='$type',reson='$reson',mute_time=mute_time+'$ban_time' where user='".urldecode($ban_l)."'") or die(mysql_error());
        }
      else
        mysql_query("insert into chat_banlist values ('','$ban_l','$ban_ip','$_SESSION[suser]','$type','$reson',mute_time+'$ban_time', '$time')") or die(mysql_error());
      mysql_query("update chat_onliners set ban='1',upd='$time' where user='".urldecode($ban_l)."' $add");
      if($ban_time<3600)
        {
        $ban_time_t=ceil($ban_time/60);
        $temp_ban=bcmod($ban_time_t,10);
        if($temp_ban==1) $ban_time_t.=" минуту";
        elseif(($temp_ban==2||$temp_ban==3||$temp_ban==4)&&bcdiv($ban_time_t,10)!=1) $ban_time_t.=" минуты";
        else $ban_time_t.=" минут";
        }
      elseif($ban_time>=3600&&$ban_time<86400)
        {
        $ban_time_t=ceil($ban_time/3600);
        $temp_ban=bcmod($ban_time_t,10);
        if($temp_ban==1) $ban_time_t.=" час";
        elseif(($temp_ban==2||$temp_ban==3||$temp_ban==4)&&bcdiv($ban_time_t,10)!=1) $ban_time_t.=" часа";
        else $ban_time_t.=" часов";
        }
      elseif($ban_time>=86400&&$ban_time<31536000)
        {
        $ban_time_t=ceil($ban_time/86400);
        $temp_ban=bcmod($ban_time_t,10);
        if($temp_ban==1) $ban_time_t.=" день";
        elseif(($temp_ban==2||$temp_ban==3||$temp_ban==4)&&bcdiv($ban_time_t,10)!=1) $ban_time_t.=" дн€";
        else $ban_time_t.=" дней";
        }
      elseif($ban_time>=31536000)
        {
        $ban_time_t=ceil($ban_time/31536000);
        $temp_ban=bcmod($ban_time_t,10);
        if($temp_ban==1) $ban_time_t.=" год";
        elseif(($temp_ban==2||$temp_ban==3||$temp_ban==4)&&bcdiv($ban_time_t,10)!=1) $ban_time_t.=" года";
        else $ban_time_t.=" лет";
        }
      @$reson_ban=mysql_result(mysql_query("select categ from chat_rules_cats where id='$reson'"),0,'categ');
      mysql_query("insert into chat_messages (room, user, message, time) values ('$_SESSION[room]','$bot_name','”частник <b>".urldecode($ban_l)."</b> был забанен модератором <b>$_SESSION[suser]</b> за <b>$reson_ban</b> на <b>$ban_time_t</b>. ','$time')") or die(mysql_error());
      mysql_query("insert into chat_logs values ('','$ban_l','$_SESSION[suser]','забанен за <b>$reson_ban</b> на <b>$ban_time_t</b>','$time')");
      }
    else
      {
      $bans=mysql_num_rows(mysql_query("select * from chat_banlist where user='$_SESSION[suser]'"));
      if($bans>0)
        {
        mysql_query("update chat_banlist set user='$_SESSION[suser]',ban='$bot_name',type='1',reson='7',mute_time=mute_time+'60' where user='".urldecode($_SESSION['suser'])."'");
        }
      else
	mysql_query("insert into chat_banlist values ('','$_SESSION[suser]','','$bot_name','1','7','60', '".time()."')") or die(mysql_error());
      $ban_time_t="1 минуту";
      $time=time();
      mysql_query("update chat_onliners set ban='1',upd='$time' where user='".urldecode($_SESSION['suser'])."'");
      mysql_query("insert into chat_messages (room, user, message, time) values ('$_SESSION[room]','$bot_name','”частник <b>".urldecode($_SESSION['suser'])."</b> был забанен модератором <b>$bot_name</b> за <b>попытку забанить старшего модератора</b> на <b>$ban_time_t</b>.','$time')");
      mysql_query("insert into chat_logs values ('','$_SESSION[suser]','$bot_name','забанен за <b>попытку забанить старшего модератора</b> на <b>$ban_time_t</b>','$time')");
      }
    }        
  $nomsg=1;
  }

### warn ###
elseif(preg_match("|^/warn[\s]+-n[\s]+([a-zA-Z0-9_]+)[\s]+-m[\s]+(.+)$|is",$msg,$cons))
  {
  $balls_us=mysql_result(mysql_query("select balls from chat_users where user='$cons[1]'"),0,'balls') or die(mysql_errro());
  if($_SESSION['balls']>$balls_us)
    {
    $cons[2]=substr($cons[2],0,60);
    $time=time();
    mysql_query("insert into chat_messages (room, user, message, time) values ('$_SESSION[room]','$bot_name','”частник <b>$cons[1]</b> получил предупреждение от модератора <b>$_SESSION[suser]</b>. ќснование: <b>$cons[2]</b>','$time');") or die(mysql_error());
    }
  $nomsg=1;
  }



?>