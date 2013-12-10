<?
if(!defined("C_MOD"))
  {
  echo "<meta http-equiv='refresh' content='0; url=../index.php'>";
  exit;
  }
if(file_exists("install")) die("<span style=\"color:#ff0000\">Удалите директорию <b>install</b></span>");
session_start();

require_once("db.php");
require_once("class.uploadimg.php");

$dbcnx=@mysql_connect($dblocation,$dbuser,$dbpasswd) or die("<p>В настоящий момент сервер базы данных не доступен, поэтому корректное отображение страницы  невозможною</p>");
@mysql_select_db($dbname,$dbcnx) or die("<p>В настоящий момент база данных недоступна, поэтому корректное отображение страницы невозможно.<p>");

if(isset($_SESSION['skin'])) $skin=$_SESSION['skin'];
$excs=array("chat_url");
$array_rand=array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","0","1","2","4","3","5","6","7","8","9");

// Конвертирует значения массива $_GET. Двумерные массивы не поддерживаются
foreach($_GET as $key_get=>$val_get)
  {
  if(is_array($_GET[$key_get]))
    foreach($_GET[$key_get] as $key2_get=>$val2_get) 
      {
      $temp_arr[$key2_get]=nl2br(htmlspecialchars(trim(stripslashes(str_replace("'","`",$val2_get)))));
      $$key_get=$temp_arr;
      }
  else $$key_get=nl2br(htmlspecialchars(trim(stripslashes(str_replace("'","`",$val_get)))));
  }

// Конвертирует значения массива $_POST с глубиной 3 (нет рекурсии, однако :))
foreach($_POST as $key_post=>$val_post)
  {
  if(!in_array($key_post,$excs))
    {
    if(is_array($_POST[$key_post]))
      {
      foreach($_POST[$key_post] as $key2_post=>$val2_post) 
        {
        if(!in_array($key2_post,$excs))
          {
          if(is_array($_POST[$key_post][$key2_post]))
            {
            $temp_arr[$key2_post]=$val2_post;
            foreach($temp_arr[$key2_post] as $key3_post=>$val3_post)
              {
              $temp_arr[$key2_post][$key3_post]=htmlspecialchars(trim(stripslashes(str_replace("'","`",$val3_post))));
              }
            }
          else
            $temp_arr[$key2_post]=htmlspecialchars(trim(stripslashes(str_replace("'","`",$val2_post))));
          $$key_post=$temp_arr;
          }
        else
          {
          $temp_arr[$key2_post]=trim(str_replace("'","`",$val2_post));
          $$key_post=$temp_arr;
          }
        }
      }
    else
      {
      $$key_post=htmlspecialchars(trim(stripslashes(str_replace("'","`",$val_post))));
      }
    }
  else $$key_post=trim(str_replace("'","`",$val_post));
  }

$query="select name,value from chat_config;";
if($result_info=mysql_query($query))
  {
  while($line=mysql_fetch_row($result_info))
    {
    $$line[0]=$line[1];
    $optval[$line[0]]=$line[1];
    }
  } 
else 
  { 
  print "Ошибка!!!";
  exit;
  }

if(!isset($_SESSION['slang']) || $_SESSION['slang']=="") $slang="russian";
else 
  {
  $check=mysql_result(mysql_query("select count(*) from chat_language where lang='$_SESSION[slang]'"),0,'count(*)');
  if($check<1) $slang="russian";
  else $slang=$_SESSION['slang'];
  }

$query_lang=mysql_query("select descr,value from chat_language where lang='$slang'") or die(mysql_error());
while($arr_lang=mysql_fetch_array($query_lang))
  {
  $expl=explode("|",$arr_lang['descr']);
  if(count($expl)>1)
    $lang[$expl[0]][$expl[1]]=$arr_lang['value'];
  else
    $lang[$arr_lang['descr']]=$arr_lang['value'];
  }

if(isset($_SESSION['room']))
  {
  $check_room=mysql_num_rows(mysql_query("select id from chat_rooms where id='$_SESSION[room]'"));
  if($check_room<1)
    {
    $min_room=mysql_result(mysql_query("select min(id) from chat_rooms"),0,'min(id)');
    mysql_query("update chat_onliners set room='$min_room'");
    $_SESSION['room']=$min_room;
    }
  $bot_name=mysql_result(mysql_query("select botname from chat_rooms where id='$_SESSION[room]'"),0,'botname');
  }

if(getenv('HTTP_X_FORWARDED_FOR')) $ip=getenv('HTTP_X_FORWARDED_FOR');
else $ip=getenv('REMOTE_ADDR');

$array_logout=array(
   "Нас покидает +u+.",
   "Среди нас дезертир! +u+ убежал(а) от нас!"); 
$array_login=array(
   "Внезапно появляется +u+!",
   "С диким криком появляется +u+.",
   "И во всём этом прикрывать вас буду я - +u+.",
   "Внезапно появляется +u+!",
   "В чат влетает +u+.",
   "А вот и +u+! Давно не виделись!",
   "Неспеша, в стрингах забегает +u+!");

$clr_code=array(1=>"000000","A0522D","556B2F","006400","000080","4B0082","8B0000","FF8C00","808000","008000","008080","0000FF","696969","FF0000","F4A460","9ACD32","48D1CC","800080","808080","FF00FF","FFA500","FFFF00","00FF00","00FFFF","00BFFF","C0C0C0","FFC0CB","98FB98","DDA0DD");
$clr_text=array();
foreach($lang['colors'] as $key=>$val) $clr_text[$key]=$val;
$opt_cs="";
foreach($clr_code as $key => $val)
  {
  $opt_cs.="<option value=\"$val\" style=\"background-color:#$val;color:#ffffff\">$clr_text[$key]";
  }

$query_smiles=mysql_query("select * from chat_smiles order by length(code) desc");
while($array_smiles=mysql_fetch_array($query_smiles))
  {
  $codes_sm[]=$array_smiles['code'];
  $urls_sm[]="<img src=\"smiles/$array_smiles[url]\" border=0>";
  }

function encode($string,$sm)
  {
  global $codes_sm,$urls_sm;
  $string=preg_replace("#\[b\](.+?)\[/b\]#is"     , "<b>\\1</b>",$string ); 
  $string=preg_replace("#\[i\](.+?)\[/i\]#is"     , "<i>\\1</i>",$string );
  $string=preg_replace("#\[u\](.+?)\[/u\]#is"     , "<u>\\1</u>",$string );
  $string=preg_replace("#\[sup\](.+?)\[/sup\]#is" , "<sup>\\1</sup>",$string );
  $string=preg_replace("#\[sub\](.+?)\[/sub\]#is" , "<sub>\\1</sub>",$string );

  $string=preg_replace("#\[center\](.+?)\[/center\]#is" , "<div align='center'>\\1</div>" , $string ); 
  $string=preg_replace("#\[right\](.+?)\[/right\]#is"   , "<div align='right'>\\1</div>"  , $string ); 
  $string=preg_replace("#\[left\](.+?)\[/left\]#is"     , "<div align='left'>\\1</div>"   , $string ); 

  $string=preg_replace("#\(c\)#i"  , "&copy;" , $string ); 
  $string=preg_replace("#\(tm\)#i" , "<sup>TM</sup>" , $string ); 
  $string=preg_replace("#\(r\)#i"  , "&reg;"  , $string ); 

  $string=preg_replace("#\[color=([^\]]+)\](.+?)\[/color\]#is" , "<span style='color:\\1'>\\2</span>"       , $string );  

  $string=str_replace("\n","<br />",$string);
  $string=eregi_replace('(http://.[-a-zA-Z0-9@:%_\+.~#?&//=]+)', '<a href="\\0" target="_blank">\\0</a>', $string);
  $string=eregi_replace("[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*","<a href=\"mailto:\\0\">\\0</a>",$string);
  $query_smiles=mysql_query("select * from expg_smiles order by length(code) desc");

  if($sm==1) $string=str_replace($codes_sm,$urls_sm,$string);
  return $string;
  }


function cmonth($string) 
  { 
  $month=array(1=>"января","февраля","марта","апреля","мая","июня","июля","августа","сентября","октября","ноября","декабря"); 
  return $month[$string]; 
  } 

function dbdate($string)
  {
  global $reg, $persearch1;
  if(preg_match("#^([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})$#is",$string,$reg))
    {
    $reg[2]=bcdiv($reg[2],1);
    $reg[2]=cmonth($reg[2]);
    $reg[3]=bcdiv($reg[3],1);
    $string="$reg[3] $reg[2] $reg[1]";
    }
  else
    {
    echo "Неверный формат даты: $string";
    }
  return $string;
  }

########## Удаление трупов #################

function delusers()
  {
  global $user_prunetime,$array_logout;
  $remtime=time()-$user_prunetime;
  $query_to=mysql_query("select user,room,lastactivity,status FROM chat_onliners WHERE lastactivity<$remtime");
  while($array_to=mysql_fetch_array($query_to))
    {
    if($array_to['status']=="free") $user_prunetime2=$user_prunetime;
    elseif($array_to['status']=="na") $user_prunetime2=$user_prunetime*10;
    elseif($array_to['status']=="away") $user_prunetime2=$user_prunetime*4;
    elseif($array_to['status']=="dnd") $user_prunetime2=$user_prunetime;
    else  $user_prunetime2=$user_prunetime;
    $remtime2=time()-$user_prunetime2;
    $message=str_replace("+u+","<b>$array_to[user]</b>",$array_logout[array_rand($array_logout,1)])." (timeout)";
    if($array_to['lastactivity']<$remtime2)
      {
      mysql_query("DELETE FROM chat_onliners WHERE user='$array_to[user]' and lastactivity<$remtime2");
      mysql_query("INSERT INTO chat_messages (room, user, message, time) VALUES ('$array_to[room]', 'Хранитель', '$message', '$array_to[lastactivity]')");
      }
    $remtime2=0;
    }
  return;
  }

delusers();
########## /Удаление трупов ################

########## Удаление банов #################
  $query_bans=mysql_query("select * from chat_banlist order by id asc");
  while($array_bans=mysql_fetch_array($query_bans))
    {
    $time=time();
    if(($time-(int)$array_bans['mute_settime'])>=(int)$array_bans['mute_time'])
      {
      mysql_query("insert into chat_logs values ('','$array_bans[user]','','<b>истёк бан</b>','$time')");
      mysql_query("delete from chat_banlist where user='$array_bans[user]'");
      }
    }
########## /Удаление банов ################

########## Удаление логов #################
  $time=time();
  $secs=$time-60*60*24*$clear_logs;
  $query=mysql_query("delete from chat_logs where time<'$secs'");
########## /Удаление логов ################

########## Удаление жалоб #################
  $time=time();
  $secs2=$time-60*60*24*$clear_compl;
  $query=mysql_query("delete from chat_compl where time<'$secs2'");
########## /Удаление жалоб ################

function pages($string)
  {
  global $maxinp,$page,$pages,$mode;
  if($string>20)
    {
    if(!$page) $page="1";
    for($i=1;$i<=$pages;$i++)
      {
      if($i!=$page)
        {
        echo "<a href=\"$_SERVER[PHP_SELF]?mode=$mode&page=$i\">$i</a> ";
        }
      else echo "$i ";
      }
    }
  else echo "1";
  }
?>