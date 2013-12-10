<?
define("C_MOD",1);
include("inc/functions.php");
$sess_id=session_id();

$title="$chat_title";
include("design/header.tpl");
echo "<table cellpadding=10 cellspacing=0 border=0><tr><td>";

if(empty($mode)) $mode="";

if($mode=="exit")
  {
  $time=time();
  if(isset($_SESSION['suser']))
    {
    $message=str_replace("+u+","<b>$_SESSION[suser]</b>",$array_logout[array_rand($array_logout,1)]);
    mysql_query("insert into chat_messages (room, user, message, time) values ('$_SESSION[room]', '$bot_name', '$message', '$time')");
    }
  mysql_query("delete from chat_onliners where sid='$sess_id'");
  session_destroy();
  foreach($_SESSION as $key=>$val)
    unset($_SESSION[$key]);
  ?><script language=javascript>parent.location.href='./index.php';</script><?
  }
elseif(isset($login)&&isset($pass))
  {
  $qlogin=mysql_escape_string(trim($login));
  $pass=trim($pass);
  if($login!=""&&$pass!="")
    {
    $authquery=mysql_query("select * from chat_users where user='$qlogin'");
    $authquery2=mysql_query("select * from chat_banlist where user='$qlogin'");
    $authresultcnt=mysql_num_rows($authquery);
    if($authresultcnt==1)
      {
      $userarr=mysql_fetch_array($authquery);
      $userarr2=mysql_fetch_array($authquery2);
      $pass=md5($pass);
      if($pass==$userarr['pass'])
        {
        $user=substr(trim($login),0,20);
	$act=mysql_num_rows(mysql_query("select * from chat_onliners where user='$user'"));
        $reb="";
        if($act>0) $reb=" (reboot)";
	mysql_query("delete from chat_onliners where user='$qlogin'");
        $old_us=mysql_query("select user,room from chat_onliners where ip='$ip'");
      	$time=time();
        /*if(mysql_num_rows($old_us)>0)
          {
          list($old_user,$old_room)=mysql_fetch_row($old_us);;
          $message=str_replace("+u+","<b>$old_user</b>",$array_logout[array_rand($array_logout,1)]);
	  mysql_query("delete from chat_onliners where ip='$ip'");
          mysql_query("insert into chat_messages (room, user, message, time) values ('$old_room', '$bot_name', '$message', '$time')");
          }*/
	if((int)$userarr2['mute_settime']>0 && (int) $userarr2['mute_time']>0)
	  {
	  if((time()-(int) $userarr2['mute_settime'])<(int)$userarr2['mute_time'])
    	    {
	    $user_ban=1;
	    }
 	  else
 	    {
	    $user_ban=0;
	    }
	  }
        else
          {
	  $user_ban=0;
	  }
	$_SESSION['room']=$room;
	$_SESSION['suser']=$userarr['user'];
	$_SESSION['skin']=$userarr['skin'];
	$_SESSION['vtime']=$userarr['time'];
	$_SESSION['smiles']=$userarr['smiles'];
	$_SESSION['skin']=$userarr['skin'];
	$_SESSION['nm']=$userarr['nm'];
	$_SESSION['send']=$userarr['send'];
	$_SESSION['focus']=$userarr['focus'];
	$_SESSION['slang']=$userarr['lang'];
	$_SESSION['status']="free";
	$_SESSION['ban']=0;
	$_SESSION['balls']=$userarr['balls'];
        $bot_name=mysql_result(mysql_query("select botname from chat_rooms where id='$_SESSION[room]'"),0,'botname');
        $message=str_replace("+u+","<b>$userarr[user]</b>",$array_login[array_rand($array_login,1)]).$reb;
      	mysql_query("insert into chat_messages (room, user, message, time) values ('$room', '$bot_name', '$message', '$time')");
	mysql_query("insert into chat_onliners (user, room, balls, ip, sid, lastactivity, lang, upd) values ('$userarr[user]', '$room', '$userarr[balls]', '$ip', '$sess_id', '$time', '$userarr[lang]', '$time')") or die("1");
        echo "<meta http-equiv=refresh content='2;url=index.php'>
        Авторизация прошла успешно! Сейчас вы будете переброшены в чат!<br>Если Вам не терпится, нажмите <a href=\"index.php\">сюда</a>";
	}
      else
        {
	echo "<span style=\"color:#ff0000\">Ошибка!</span> Неверный логин или пароль!";
	}
      }
    else
      {
      echo "<span style=\"color:#ff0000\">Ошибка!</span> Такого пользователя не существует!";
      }
    }
  else
    {
    echo "<span style=\"color:#ff0000\">Ошибка!</span> Не введён логин или пароль!";
    }
  }
else
  {
  echo "<meta http-equiv=refresh content='2;url=index.php'>
  Сначала нужно авторизироваться!";
  exit;
  }
echo "</td></tr></table>";
include("design/footer.tpl");
?>