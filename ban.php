<?
define("C_MOD",1);
include("inc/functions.php");

if(empty($act)) $act="";
if(empty($login)) $login="";
if(empty($ip)) $ip="";

if($mode=="add")
  {
  if($act=="add"&&$_SESSION['balls']>=500)
    {
    if(empty($c_ip)) { $ban_ip=""; $add=""; }
    else $add="or ip='$ban_ip'";
    if(empty($c_login)) $ban_login="";
    if(empty($ban_login)&&empty($ban_ip)) $error=1;
    if(empty($reson)) $error=1;
    if(empty($ban_login)&&!empty($ban_ip)) $ban_l=@mysql_result(mysql_query("select user from chat_onliners where ip='$ban_ip'"),0,'user');
    else $ban_l=$ban_login;
    if(empty($ban_l)) $error=1;
    if(empty($error))
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
          elseif(($temp_ban==2||$temp_ban==3||$temp_ban==4)&&bcdiv($ban_time_t,10)!=1) $ban_time_t.=" дня";
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
        mysql_query("insert into chat_messages (room, user, message, time) values ('$_SESSION[room]','$bot_name','Участник <b>".urldecode($ban_l)."</b> был забанен модератором <b>$_SESSION[suser]</b> за <b>$reson_ban</b> на <b>$ban_time_t</b>. ','$time')") or die(mysql_error());
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
        mysql_query("insert into chat_messages (room, user, message, time) values ('$_SESSION[room]','$bot_name','Участник <b>".urldecode($_SESSION['suser'])."</b> был забанен модератором <b>$bot_name</b> за <b>попытку забанить старшего модератора</b> на <b>$ban_time_t</b>.','$time')");
        mysql_query("insert into chat_logs values ('','$_SESSION[suser]','$bot_name','забанен за <b>попытку забанить старшего модератора</b> на <b>$ban_time_t</b>','$time')");
        }
      }        
    ?><html><head></head><body><script language=javascript>window.close();</script></body></html><?
    }
  elseif($_SESSION['balls']>=500)
    {
    if(empty($ips)) $ips="";
    $opt_time="";
    foreach($lang['btime'] as $key=>$val)
      $opt_time.="<option value=".(int)$key.">$val\r\n";?>
    <html>
    <head><title><?echo$lang['addban2'];?></title>
    <meta http-equiv="content-type" Content="text/html;charset=windows-1251">
    <script language="JavaScript">
    <!--
    window.moveTo((screen.width-530)/2 , ((screen.height-302)/2)-100);
    //-->
    </script>
    <style>
    .small
    {
    Font-Family: Tahoma, Arial;
    Font-size: 11px;
    }
    </style>
    </head>
    <body>
    <table cellpadding="2" cellspacing="2" border="0">
    <form name='form' action='ban.php?mode=add' method='post'>
    <input type="hidden" name="act" value="add">
    <tr valign="top">
    <td align="right"><b><?echo$lang['nick'];?>:</b></td>
    <td><input type="checkbox" name="c_login" checked>&nbsp;<input type="text" name="ban_login" style="width:400;" value="<?echo$login;?>"></td>
    </tr>
    <tr valign="top">
    <td align="right"><b><?echo$lang['ip'];?>:</b></td>
    <td><input type="checkbox" name="c_ip">&nbsp;<input type="text" name="ban_ip" style="width:400;" value="<?echo$ips;?>"></td>
    </tr>
    <tr valign="top">
    <td align="right"><b><?echo$lang['type'];?>:</b></td>
    <td><select name="type">
    <option value="1"><?echo$lang['tban'][1];?>
    <option value="2"><?echo$lang['tban'][2];?>
    <option value="3"><?echo$lang['tban'][3];?></select></td>
    </tr>
    <tr valign="top">
    <td align="right"><b><?echo$lang['reson'];?>:</b></td>
    <td><select name="reson" style="width:422;" multiple size="4" class="small"><?
    $query_rulcats=mysql_query("select * from chat_rules_cats order by id");
    while($array_rulcats=mysql_fetch_array($query_rulcats))
      {
      echo "<option value=\"$array_rulcats[id]\">$array_rulcats[categ]</option>\r\n";
      }?>
    </select></td></tr>
    <tr valign="top">
    <td align="right"><b><?echo$lang['time'];?>:</b></td>
    <td><select name="ban_time" style="width:422;"><?echo$opt_time;?></select></td>
    </tr>
    <tr valign="top">
    <td></td>
    <td align="right"><input value="<?echo$lang['addban'];?>" type="submit">&nbsp;<input name="exit" onclick="window.close();" value="<?echo$lang['cancel'];?>" type="button"></td>
    </tr>
    </form>
    </table>
    </body>
    </html><?
    }
  }
elseif($mode=="addwarn"&&$_SESSION['balls']>=500)
  {
  if($act=="add"&&$_SESSION['balls']>=500)
    {
    if(empty($content)) $error=1;
    if(empty($warn_user)) $error=1;
    if(empty($error))
      {
      $balls_us=mysql_result(mysql_query("select balls from chat_users where user='$warn_user'"),0,'balls') or die(mysql_error());
      if($_SESSION['balls']>$balls_us)
        {
        $content=substr($content,0,60);
        $time=time();
        mysql_query("insert into chat_messages (room, user, message, time) values ('$_SESSION[room]','$bot_name','Участник <b>$warn_user</b> получил предупреждение от модератора <b>$_SESSION[suser]</b>. Основание: <b>$content</b>','$time');") or die(mysql_error());
        }
      ?><html><head></head><body><script language=javascript>window.close();</script></body></html><?
      }
    }
  elseif($_SESSION['balls']>=500)
    {
    $login=urldecode($login);?>
    <html>
    <head><title><?echo$lang['addwarn2'];?></title>
    <meta http-equiv="content-type" Content="text/html;charset=windows-1251">
    <script language="JavaScript">
    <!--
    window.moveTo((screen.width-530)/2 , ((screen.height-302)/2)-100);
    //-->
    </script>
    <style>
    .small
    {
    Font-Family: Tahoma, Arial;
    Font-size: 11px;
    }
    </style>
    </head>
    <body>
    <table cellpadding="2" cellspacing="2" border="0" width=100%>
    <form name='form' action='ban.php?mode=addwarn' method='post'>
    <input type="hidden" name="act" value="add">
    <input type="hidden" name="warn_user" value="<?echo urldecode($login);?>">
    <tr valign="top">
    <td align="right" width=30%><b><?echo$lang['addwarn3'];?>:</b></td>
    <td width=70%><?echo urldecode($login);?></td>
    </tr>
    <tr valign="top">
    <td align="right"><b><?echo$lang['text2'];?>:</b></td>
    <td><textarea style="width:100%" rows=10 name=content maxlength=60></textarea></td>
    </tr>
    <tr valign="top">
    <td></td>
    <td align="right"><input value="<?echo$lang['addwarn'];?>" type="submit">&nbsp;<input name="exit" onclick="window.close();" value="<?echo$lang['cancel'];?>" type="button"></td>
    </tr>
    </table>
    </body></html><?
    }
  }
elseif($mode=="list"&&$_SESSION['balls']>=500)
  {
  if(!empty($unban)&&$_SESSION['balls']>=500)
    {
    if(empty($ips)) { $ips=""; $add=""; }
    else $add="or ip='$ips'";
    if(empty($unban)) $unban="";
    if(empty($error))
      {
      $mod=mysql_result(mysql_query("select ban from chat_banlist where user='".urldecode($unban)."'"),0,'ban');
      if($mod=="$bot_name")  $balls_mod=999;
      else
        $balls_mod=mysql_result(mysql_query("select balls from chat_users where user='$mod'"),0,'balls');
      if($_SESSION['balls']>=$balls_mod)
        {
        $time=time();
        mysql_query("delete from chat_banlist where user='".urldecode($unban)."' $add");
        mysql_query("update chat_onliners set ban='0',upd='$time' where user='".mysql_escape_string(urldecode($unban))."' $add");
        mysql_query("insert into chat_messages (room, user, message, time) values ('$_SESSION[room]','$bot_name','С участника <b>".urldecode($unban)."</b> был снят бан модератором <b>$_SESSION[suser]</b>.','$time')") or die(mysql_error());
        mysql_query("insert into chat_logs values ('','$unban','$_SESSION[suser]','<b>снят бан</b>','$time')");
        }
      else
        {
        $bans=mysql_num_rows(mysql_query("select * from chat_banlist where user='".urldecode($_SESSION['suser'])."'"));
        if($bans>0)
          {
          mysql_query("update chat_banlist set user='$_SESSION[suser]',ban='$bot_name',type='1',reson='7',mute_time=mute_time+'60' where user='".urldecode($_SESSION['suser'])."'");
          }
        else
          mysql_query("insert into chat_banlist values ('','$_SESSION[suser]','','$bot_name','7','1','60','".time()."')");
        $ban_time_t="1 минуту";
        $time=time();
        mysql_query("update chat_onliners set ban='1',upd='$time' where user='".urldecode($_SESSION['suser'])."'");
        mysql_query("insert into chat_messages (room, user, message, time) values ('$_SESSION[room]','$bot_name','Участник <b>".urldecode($_SESSION['suser'])."</b> был забанен модератором <b>$bot_name</b> за <b>попытку разбанить бан старшего модератора</b> на <b>$ban_time_t</b>.','$time')") or die(mysql_error());
        mysql_query("insert into chat_logs values ('','$_SESSION[suser]','$bot_name','забанен за <b>попытку разбанить бан старшего модератора</b> на <b>$ban_time_t</b>','$time')");
        }
        ?><script language=javascript>parent.location.href='./ban.php?mode=list';</script><?
      } 
    }
  else
    {
    echo "<html>
    <head><title>$lang[banlist]</title>
    <meta http-equiv=\"content-type\" Content=\"text/html;charset=windows-1251\">
    <style>
    body,table,tr,td {font-family:Verdana;font-size:10px;}
    .t1 {background-color: #efefef}
    .t2 {background-color: #ffffff}
    </style>
    <script language=JavaScript>
    <!--
    window.moveTo((screen.width-750)/2 , ((screen.height-500)/2)-50);
    //-->
    </script></head>
    <body>
    <center><h2>$lang[banlist]</h2></center>
    <table align=center cellpadding=2 cellspacing=1 width=100%>";
    echo "<tr align=center bgcolor=#EFEFEF>
    <td><b>$lang[id]</b></td>
    <td><b>$lang[moderator]</b></td>
    <td><b>$lang[when]</b></td>
    <td><b>$lang[to]</b></td>
    <td><b>$lang[user]</b></td>
    <td><b>$lang[ip]</b></td>
    <td><b>$lang[reson]</b></td>
    <td><b>x</b></td></tr>";
    $query_bans=mysql_query("select chat_banlist.user,chat_banlist.ban,chat_banlist.reson,
    chat_banlist.ip,chat_banlist.mute_time,chat_banlist.mute_settime from chat_banlist,chat_users
    where chat_banlist.user=chat_users.user and chat_banlist.mute_time>0 and chat_banlist.mute_settime>0 order by chat_banlist.mute_settime desc");
    $id=1;
    while($array_bans=mysql_fetch_array($query_bans))
      {
      $s_time=date("d.m.Y H:i:s",$array_bans['mute_settime']);
      $f_time=date("d.m.Y H:i:s",$array_bans['mute_settime']+$array_bans['mute_time']);
     $reson=mysql_result(mysql_query("select categ from chat_rules_cats where id='$array_bans[reson]'"),0,'categ');
      echo "<tr bgcolor=#ffffff onmouseover=\"this.className='t1'\" onmouseout=\"this.className='t2'\">";
      echo "<td>$id</td>
      <td>$array_bans[ban]</td>
      <td>$s_time</td>
      <td>$f_time</td>
      <td>$array_bans[user]</td>
      <td>$array_bans[ip]</td>
      <td>$reson</td>
      <td><a href=\"ban.php?mode=list&unban=".urlencode($array_bans['user'])."&ips=$array_bans[ip]\">x</a></tr>";
      $id++;
      }
    echo "</table></body></html>";
    }
  }
elseif($mode=="logs"&&$_SESSION['balls']>=500)
  {
  if(empty($d_s)) $d_s=0;
  if(empty($d_f)) $d_f=0;
  if(empty($m_s)) $m_s=0;
  if(empty($m_f)) $m_f=0;
  if(empty($y_s)) $y_s=0;
  if(empty($y_f)) $y_f=0;
  if(empty($s)) $s=0;
  if(empty($f)) $f=0;
  if(empty($view)) $view="";
  $arr30=array(4,6,9,11);
  if(in_array($m_s,$arr30)&&$d_s==31) $d_s=30;
  elseif($m_s==2&&$d_s>28) $d_s=28;
  if(in_array($m_f,$arr30)&&$d_f==31) $d_f=30;
  elseif($m_f==2&&$d_f>28) $d_f=28;
  $opt_ds=$opt_df=$opt_ms=$opt_mf=$opt_ys=$opt_yf="";
  $time_s=mktime(0,0,0,$m_s,$d_s,$y_s);
  $time_f=mktime(0,0,0,$m_f,$d_f,$y_f);
  for($i=1;$i<=31;$i++)
    {
    $opt_ds.="<option value=$i";
    $opt_df.="<option value=$i";
    if($d_s==$i) $opt_ds.=" selected";
    if($d_f==$i) $opt_df.=" selected";
    $opt_ds.=">$i</option>";
    $opt_df.=">$i</option>";
    }
  $arr_m=array(0=>" ");
  foreach($lang['months'] as $key=>$val) $arr_m[$key]=$val;
  for($i=1;$i<=12;$i++)
    {
    $opt_ms.="<option value=$i";
    $opt_mf.="<option value=$i";
    if($m_s==$i) $opt_ms.=" selected";
    if($m_f==$i) $opt_mf.=" selected";
    $opt_ms.=">$arr_m[$i]</option>";
    $opt_mf.=">$arr_m[$i]</option>";
    }
  $min_y=date("Y",mysql_result(mysql_query("select min(time) from chat_logs"),0,'min(time)'));
  $max_y=date("Y",mysql_result(mysql_query("select max(time) from chat_logs"),0,'max(time)'));
  for($i=$min_y;$i<=$max_y;$i++)
    {
    $opt_ys.="<option value=$i";
    $opt_yf.="<option value=$i";
    if($y_s==$i) $opt_ys.=" selected";
    if($y_f==$i) $opt_yf.=" selected";
    $opt_ys.=">$i</option>";
    $opt_yf.=">$i</option>";
    }
  echo "<html>
  <head><title>$lang[banlogs]</title>
  <meta http-equiv=\"content-type\" Content=\"text/html;charset=windows-1251\">
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
  <center><h2>$lang[banlogs]</h2>";
  if($view==1) echo " (<a href=ban.php?mode=logs&s=$time_s&f=$time_f>$lang[clear3]</a>)";
  echo " (<a href=ban.php?mode=logs&s=1&f=2000000000>$lang[clear2]</a>)</center>
  <form action=ban.php?mode=logs method=post>
  <input type=hidden name=view value=1>
  <b>$lang[view2]: <select name=d_s>$opt_ds</select> <select name=m_s>$opt_ms</select> <select name=y_s>$opt_ys</select>
  $lang[to]: <select name=d_f>$opt_df</select> <select name=m_f>$opt_mf</select> <select name=y_f>$opt_yf</select></b>
  <input type=submit value=\"$lang[view]\"></form>";
  if($view==1)
    {
    echo "<table align=center cellpadding=2 cellspacing=1 width=100%>
    <tr align=center bgcolor=#EFEFEF>
    <td><b>$lang[id]</b></td>
    <td><b>$lang[user]</b></td>
    <td><b>$lang[moderator]</b></td>
    <td><b>$lang[when]</b></td>
    <td><b>$lang[text]</b></td></tr>";
    $p=1;
    $query_logs=mysql_query("select * from chat_logs where time>='$time_s' and time<='$time_f' order by time");
    while($array_logs=mysql_fetch_array($query_logs))
      {
      $date=date("H:i:s d.m.Y",$array_logs['time']);
      echo "<tr bgcolor=#ffffff onmouseover=\"this.className='t1'\" onmouseout=\"this.className='t2'\">";
      echo "<td>$p</td>";
      echo "<td>$array_logs[user]</td>";
      echo "<td>$array_logs[moder]</td>";
      echo "<td>$date</td>";
      echo "<td>$array_logs[text]</td>";
      echo "</tr>";
      $p++;
      }
    echo "</table>";
    }
  elseif($s>0&&$f>0)
    {
    if(mysql_query("delete from chat_logs where time>='$s' and time<='$f'"))
      echo $lang['complete']['clearlogs'];
    else
      echo $lang['complete']['errlogs'];
    }
  echo "</body></html>";
  }
else
  {
  echo "<html><head></head><body><script language=javascript>window.close();</script></body></html>";
  }
?>