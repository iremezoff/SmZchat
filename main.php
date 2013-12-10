<?
define("C_MOD",1);
include("inc/functions.php");

$sess_id=session_id();

header("Content-type: text/plain; charset=windows-1251");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);

if(isset($_SESSION['suser']))
  {
  $qlogin=mysql_escape_string(trim($_SESSION['suser']));
  $checkauth=mysql_query("select sid from chat_onliners where user='$qlogin' and sid='$sess_id'");
  $resultcnt=mysql_num_rows($checkauth);
  mysql_free_result($checkauth);
  if($resultcnt==1)
    {
    include("theme/$skin/colors.php");
    $now=time();
    mysql_query("update chat_onliners set lastactivity='$now' where user='$qlogin'");
    if(isset($_SESSION['lst']) && (int) $_SESSION['lst'] > 0)
      {
      $get_lastmsgid=(int)$_SESSION['lst'];
      }
    else
      {
      $get_lastmsgid=0;
      }
    $result=mysql_query("select max(id) from chat_messages where room='$_SESSION[room]'");
    if(mysql_num_rows($result) == 1)
      {
      $lastmsg=mysql_fetch_row($result);
      $lastmsgid=$lastmsg[0];
      }
    else
      {
      $lastmsgid=0;
      }
    mysql_free_result($result);
    $query_lastid=mysql_query("select id from chat_messages where room='$_SESSION[room]' order by id desc limit $savemsgcount,1") or die(mysql_error());
    @$lastid=mysql_result($query_lastid,0,'id');
    if($lastid<1||empty($lastid))
      $lastid=$lastmsgid-$savemsgcount;
    mysql_free_result($query_lastid);
    mysql_query("DELETE from chat_messages where id<'$lastid' and room='$_SESSION[room]'");
    $output="";
    $query_mess=mysql_query("select * from chat_messages where id>".$get_lastmsgid." and room='$_SESSION[room]' order by id asc");
    while($msgs=mysql_fetch_array($query_mess))
      {
      if($_SESSION['vtime']=="hm") $tptime="H:i";
      elseif($_SESSION['vtime']=="ms") $tptime="i:s";
      elseif($_SESSION['vtime']=="hms") $tptime="H:i:s";
      else $tptime="H:i";
      eval("\$date=date(\"\$tptime\",\$msgs['time']);");
      if($msgs['userto']==$_SESSION['suser'])
        {
        if($msgs['private']==0) $fon=$color['meall'];
        else $fon=$color['meprivate'];
        }
      elseif(trim(strtolower($msgs['user']))==trim(strtolower($qlogin)) )
        {
        if($msgs['private']==0) $fon=$color['toall'];
        else $fon=$color['toprivate'];
        }
      else
        {
        $fon=$color['bgcolor'];
        }
      $query_ign=mysql_query("select id from chat_ignore where user='$_SESSION[suser]' and ignores='$msgs[user]'");
      $ign=mysql_num_rows($query_ign);
      if($msgs['private']==0&&$ign<1)
        {
        if($msgs['color']==$color['bgcolor']) $msgs['color']="#00ff00";
        $output.="mess|no|$fon|$msgs[color]|$date|$msgs[user]|$msgs[userto]|$msgs[message]:::";
        }
      else
        {
        if((trim($msgs['userto'])==trim($qlogin) || trim($msgs['user'])==trim($qlogin))&&$ign<1)
          {
          if($msgs['color']==$color['bgcolor']) $msgs['color']="#00ff00";
          $output.="mess|yes|$fon|$msgs[color]|$date|$msgs[user]|$msgs[userto]|$msgs[message]:::";
          }
        }
      }
    mysql_free_result($query_mess);
    $query=mysql_query("select ban,type,reson,mute_time,mute_settime from chat_banlist where user='$qlogin' or ip='$ip'");
    $resultcnt=mysql_num_rows($query);
    if($resultcnt>=1)
      {
      $time=time();
      $banarr=mysql_fetch_array($query);
      if((int)$banarr['mute_time']>0&&(int)$banarr['mute_settime']>0)
        {
        if((time()-(int)$banarr['mute_settime'])<(int)$banarr['mute_time'])
          {
          @$reson_ban=mysql_result(mysql_query("select categ from chat_rules_cats where id='$banarr[reson]'"),0,'categ');
	  $muteremaintime=(int)$banarr['mute_time']-time()+(int)$banarr['mute_settime'];
          $_SESSION['ban']=1;
          mysql_query("update chat_onliners set ban='1' where user='$qlogin' or ip='$ip'");
          $output.="ban|$_SESSION[suser]|$banarr[ban]|$reson_ban|$muteremaintime:::";
          if($banarr['type']==2) $output.="logout:::";
	  elseif($banarr['type']==3) $output2="ban|$_SESSION[suser]|$banarr[ban]|$reson_ban|$muteremaintime:::";
	  }
        else
          {
	  $_SESSION['ban']=0;
          mysql_query("update chat_banlist set mute_time='0',mute_settime='0' where user='$_SESSION[suser]' or ip='$ip'");
          mysql_query("update chat_onliners set ban='0',upd='$time' where user='$qlogin' or ip='$ip'");
          $output.="ban||||0:::";
	  }
        }
      else
        {
        $_SESSION['ban']=0;
        mysql_query("update chat_onliners set ban='0',upd='$time' where user='$qlogin' or ip='$ip'");
        $output.="ban||||0:::";
        }
      }
    else
      {
      $_SESSION['ban']=0;
      $output.="ban||||0:::";
      }
    mysql_free_result($query);
    $query_upd=mysql_query("select sum(upd) from chat_onliners where room='$_SESSION[room]'");
    $getupd=mysql_result($query_upd,0,'sum(upd)');
    if($getupd==0) $getupd=1;
    mysql_free_result($query_upd);
    if($_SESSION['upd']!=$getupd)
      {
      $_SESSION['upd']=$getupd;
      $output.="clear_u:::";
      $query_us=mysql_query("select * from chat_onliners where room='$_SESSION[room]' order by lastactivity");
      while($array_us=mysql_fetch_array($query_us))
        {
        if($_SESSION['suser']!=$array_us['user'])
          {
          $query_ign=mysql_query("select id from chat_ignore where user='$_SESSION[suser]' and ignores='$array_us[user]'");
          $ign=mysql_num_rows($query_ign);
          if($ign>1) $ign=1;
          }
        else $ign=0;
        if(strtolower($_SESSION['suser'])==strtolower($array_us['user'])) $_SESSION['balls']=$array_us['balls'];
        $output.="usrs|$array_us[user]|$array_us[balls]|$array_us[status]|$ign|$array_us[ban]|$array_us[ip]|$array_us[sid]|sfdhytr5756uh5:::";
        }
      mysql_free_result($query_us);
      }
    $_SESSION['lst']=$lastmsgid;
    if(isset($banarr['type'])&&$banarr['type']==3) $output=$output2;
    echo $output;
    }
  else
    {
    echo "logout:::";
    }
  }
else
  {
  echo "logout:::";
  }
?>