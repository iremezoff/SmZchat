<?
error_reporting (E_ERROR | E_WARNING | E_PARSE);

if(!file_exists("sql.sql")) die("����������� ���� <b>sql.sql</b> ��� <b>sql_update.sql</b>");

$script_name="SmZchat vioo3";
$other_title="��������� $script_name";

include("design/header.tpl");

function shield($next,$text,$help,$form_other,$block)
  {
  global $script_name, $step;?>
<form action=index.php?step=<?echo$next;?> method=post>
<?
if($block!=1) echo "<input type=hidden name=action value=go>";
echo $form_other;
?>
<table cellspacing=0 cellpadding=0 width=100% border=0 height=100%>
  <tr>
   <td colspan=3 valign=top width=100% height=25% bgcolor="#0000B9">
   <span style="font-size: 16pt; font-weight: bold; font-family: arial; color: #ffffff"><i><?echo$script_name;?></i></span></td>
  </tr>
  <tr>
   <td width=25% height=50% bgcolor="#0000B9"></td>
   <td width=50% height=50% bgcolor="#0000B9">
   <table cellpadding=0 cellspacing=0 border=0 width=100% height=400>
     <tr>
      <td valign=top>
      <table cellpadding=0 cellspacing=0 border=0 width=100% height=29>
        <tr>
         <td width=7 height=29><img src="images/left.gif" width=7 height=29></td>
         <td background="images/header.gif" width=100% height=29>
         <span style="color: #ffffff; font-weight: bold;">��������� <?echo$script_name;?></span></td>
         <td background="images/header.gif" width=21 height=21>
         <a href="#" onClick="parent.close(); return false;" title="�������">
         <img src="images/close.gif" width=21 height=21 border=0></a></td>
         <td width=7 height=29><img src="images/right.gif" width=7 height=29></td>
        </tr>
      </table>
      <table cellpadding=0 cellspacing=0 border=0 width=100% height=371>
        <tr>
         <td width=3><img src="images/border.gif" width=3 height=100%></td>
         <td width=100% valign=top>
         <table cellpadding=0 cellspacing=0 border=0 width=100% height=371>
           <tr>
            <td colspan=3 height=50 bgcolor="#003366">
            &nbsp;<span class=smallfont style="color: #ffffff"><?echo$help;?></span></td>
           </tr>
           <tr>
            <td colspan=3 height=1><img src="images/line1.gif" width=100% height=1></td>
           </tr>
           <tr>
            <td width=20% valign=top height=277 bgcolor="#4982C3" align=center>
            <span style="color: #ffffff; font-weight: bold">Powered by</span>
            <img src="images/phpinfo.gif">
            <img src="images/mysql.gif"></td>
            <td width=1><img src="images/line2.gif" width=1 height=100% border=0></td>
            <td width=80% align=center height=277 bgcolor="#3D66AB">
            <span style="color: #ffffff"><?echo$text;?></span></td>
           </tr>
           <tr>
            <td width=100% height=43 colspan=3>
            <table cellpadding=0 cellspacing=0 width=100% border=0 height=43>
              <tr>
               <td width=20% align=center background="images/line3.gif">
               <span style="font-size: 8pt; font-weight: bold; color: #8B8CA4"><b>php</b></span><span style="font-size: 7pt; font-weight: bold; color: #8B8CA4">InstallShield v1.4</span></td>
               <td width=1 bgcolor=#ffffff><img href="images/point.gif" width=1 height=100%></td>
               <td width=80% background="images/line4.gif" align=center>
               <?if($step && $step<6)
               echo "<a href=\"javascript:history.go(-1)\"><img src=\"images/button_back.gif\" border=0></a>";?>
               <?if(!$block || $block==0) echo "<input type=image src=\"images/button_next.gif\">";
               if($step==5) echo "<a href=\"../index.php\"><img src=\"images/button_finish.gif\" border=0></a>";?></td>
              </tr>
            </table></td>
           </tr>
         </table></td>
         <td width=3><img src="images/border.gif" width=3 height=100%></td>
        </tr>
        <tr>
         <td valign=top height=3 colspan=3 width=1 background="images/border_b.gif"></td>
        </tr>
      </table></td>
     </tr>
   </table></td>
   <td width=25% height=50% bgcolor="#0000B9"></td>
  </tr>
  <tr>
   <td colspan=3 width=100% height=25% bgcolor="#0000B9">&nbsp;</td>
  </tr>
</table>
</form><?
  }

$step       = $_GET[step];
$go         = $_POST[go];
$chat_url   = $_POST[chat_url];
$chat_title = $_POST[chat_title];
$admin_mail = $_POST[admin_mail];
$login      = $_POST[login];
$password   = $_POST[password];
$dblocation = $_POST[dblocation];
$dbname     = $_POST[dbname];
$dbuser     = $_POST[dbuser];
$dbpasswd   = $_POST[dbpasswd];
$action     = $_POST[action];
$rw	    = $_POST[rw];
$act	    = $_POST[act];
$v_up	    = $_POST[v_up];
$login      = $_POST[login];
$password   = $_POST[password];
$confirm_password   = $_POST[confirm_password];

if(!$step || $step>5) $step=0;

if($step==0)
  {
  $text="������ ������� ��������� ������� \"<b>$script_name</b>\".
  ��������� ������ ������ �� ������ <b>\"�����\"</b>.
  ������� ����� ����� ������� ��������� ����� ��, ����� ���� �������� ��������� �������.";
  $help="�� � ���� �� ������!";
  shield(1,$text,$help,"",0);
  }

elseif($step==1)
  {
  include("../inc/db.php");
  $text="������� ��������� ����� ��:";
  $text.="
  <table border=0 style=\"color: #ffffff;\">
  <tr>
  <td>��� ������� mySQL</td>
  <td><input type=text name=dblocation size=25 value=\"$dblocation\"></td>
  </tr>
  <tr>
  <td>�������� ����� ��</td>
  <td><input type=text name=dbname size=25 value=\"$dbname\"></td>
  </tr>
  <tr>
  <td>��� ������������ ��</td>
  <td><input type=text name=dbuser size=25 value=\"$dbuser\"></td>
  </tr>
  <tr>
  <td>������ � ��</td>
  <td><input type=text name=dbpasswd size=25 value=\"$dbpasswd\"></td>
  </tr>
  <tr>
  <td>���� ���������� ��</td>
  <td><input type=radio name=rw value=1 checked> ������������ (����� ����� <b>0777</b>)<br>
  <input type=radio name=rw value=2> �������� ������� ���������</td>
  </tr>
  <tr>
  <td>�������� � ��</td>
  <td><input type=radio name=act value=1 checked> �������������� <b>(���� sql.sql)</b><br>
  <input type=radio name=act value=2> �������� <b/>(���� sql_update.sql)</b></td>
  </tr>
  </table>";
  $help="��������� �� ������������� ��� ������ �������. ������ �������� � �������������� mySQL";
  shield(2,$text,$help,"",0);
  }
elseif($step==2)
  {
  if($action=="go")
    {
    if($act==2)
      {
      $opts="";
      $dir=opendir(".");
      while($sql_file=readdir($dir))
        {
	if(preg_match("|^sql_update_([a-zA-Z0-9-]*).sql$|i",$sql_file,$file))
	  {
	  $opts.="<option value=$file[1]>SmZchat $file[1]</option>";
	  }
        }
      closedir($dir);
      $form_other="<input type=hidden name=action value=go>
      <input type=hidden name=act value=3>
      <input type=hidden name=rw value=$rw>
      <input type=hidden name=dblocation value=\"$dblocation\">
      <input type=hidden name=dbname value=\"$dbname\">
      <input type=hidden name=dbuser value=\"$dbuser\">
      <input type=hidden name=dbpasswd value=\"$dbpasswd\">";
      $text="<table border=0 style=\"color:#ffffff\"><tr><td width=50%>�������� ������ ����, � ������� ���������� ����������:</td><td width=50%><select name=v_up style=\"width: 150px\">$opts</option></td></tr></table>";
      $help="����� ���������� ������ ����, � ������� ���������� ����������";
      shield(2,$text,$help,$form_other,0);
      }
    else
      {
      if(!$dblocation&&$rw==1) $error.="�� �� ����� ��� ������� mySQL<br>";
      if(!$dbname&&$rw==1)     $error.="�� �� ����� �������� ����� ��<br>";
      if(!$dbuser&&$rw==1)     $error.="�� �� ����� ��� ������������ ��<br>";
      #if(!$dbpasswd&&$rw==1)   $error.="�� �� ����� ������ � ��";
      if(!$error)
        {
        $error="";
        if($rw==1)
          {
          chdir("../inc");
          @chmod("db.php",0777);
          chdir("../install");
          $db_file=fopen("../inc/db.php",w);
          $db_content="<?\r\n\$dblocation=\"$dblocation\";\r\n\$dbname=\"$dbname\";\r\n\$dbuser=\"$dbuser\";\r\n\$dbpasswd=\"$dbpasswd\";\r\n?>";
          $error="";
          if(@fwrite($db_file,"$db_content"))
            {
            $ypa="������ � ���� ������ �������!<br>";
            }
          else
            {
            $error.="������ ��� ������ � ����! ��������� ����� ������� � �����<br>";
            }
          }
        if(!$db_check1=mysql_connect($dblocation,$dbuser,$dbpasswd))
          {
          if(!$db_check2=mysql_select_db($dbname,$db_check1))
            {
            $error.="<span style=\"font-size: 16pt; color: #FF6B6B\">������ ��� ����������� � ��! ��������� ���� ���������!</span><br>";
            }
          }
        else
          {
          $ypa.="<span style=\"font-size: 16pt; color: #20C82C\">����� � �� ������ �������! ������ � �� �������</span><br><br>";
          }
        if(!$error)
          {
          include("../inc/db.php");
          $dbcnx=@mysql_connect($dblocation,$dbuser,$dbpasswd) or die("<p>� ��������� ������ ������ ���� ������ �� ��������, ������� ���������� ����������� ��������  �����������</p>");
          @mysql_select_db($dbname,$dbcnx) or die("<p>� ��������� ������ ���� ������ ����������, ������� ���������� ����������� �������� ����������.<p>");
        if($act==3&&file_exists("sql_update_".$v_up.".sql")) $sql_file=file("sql_update_".$v_up.".sql");
        else $sql_file=file("sql.sql");
        $sql_count=count($sql_file);
        for($i=0;$i<$sql_count;$i++)
          {
          $comment=substr($sql_file[$i],0,1);
          if($comment!="#" && $sql_file[$i]!="" && $sql_file[$i]!="\r\n")
            {
            $sql_querys.=rtrim(ltrim($sql_file[$i]));
            $sql_querys.="\r\n";
            }
          }
        $sql_array=explode(";\r\n", $sql_querys);
        $count_array=count($sql_array);
        $sqls=0;
        for($i=0;$i<$count_array;$i++)
          {
          if($sql_array[$i]!="" && strlen($sql_array[$i])>10)
            {
            mysql_query($sql_array[$i]) or die("<font color=res><b>��������� ������!::</b></font> $i of $count_array<br><b>������:</b> $sql_array[$i]<br><b>����� mySQL:</b> ".mysql_error());
            $sqls++;
            }
          }
        $text=$ypa."����� ���������� <b>$sqls</b> sql-��������. ��� ������� � �� �������.<br>����� ������ \"�����\"";
        $help="���������� �������� ����������� ����������";
	if($act==3) { $nextstep=5; $form_other="<input type=hidden name=act value=$act>"; }
	else $nextstep=3;
        shield($nextstep,$text,$help,$form_other,0);
        }
      else
        {
        $text="��������� ��������� ������:<br> $error<br><br>������� \"�����\" � ��������� �������� ������.";
        $help="���������� �������� ����������� ����������";
        shield(2,$text,$help,"",1);
        }
      }
    else
      {
      $text="��������� ��������� ������:<br>$error";
      $help="���������� �������� ����������� ����������";
      shield(2,$text,$help,"",1);
      }
    }
    }
  else echo "<meta http-equiv='refresh' content='0; url=index.php?'>";
  }

elseif($step==3)
  {
  if($action=="go")
    {
    $text="
    <table border=0 style=\"color: #ffffff\">
    <tr>
    <td>����� URL ����:</td>
    <td><input type=text name=chat_url value=\"http://$_SERVER[SERVER_NAME]/\"></td>
    </tr>
    <tr>
    <td>��������� ����:</td>
    <td><input type=text name=chat_title></td>
    </tr>
    <tr>
    <td>E-mail �������������� ����:</td>
    <td><input type=text name=admin_mail></td>
    </tr>
    </table>";
    $help="������� �������� ��������� �������";
    shield(4,$text,$help,"",0);
    }
  else echo"<meta http-equiv='refresh' content='0; url=index.php?step=2'>";
  }
    
elseif($step==4)
  {
  if($action=="go")
    {
    include("../inc/db.php");
    $dbcnx=@mysql_connect($dblocation,$dbuser,$dbpasswd) or die("<p>� ��������� ������ ������ ���� ������ �� ��������, ������� ���������� ����������� ��������  �����������</p>");
    @mysql_select_db($dbname,$dbcnx) or die("<p>� ��������� ������ ���� ������ ����������, ������� ���������� ����������� �������� ����������.<p>");
    if(!$chat_url) $error.="�� ����� url ����<br>";
    if(!$chat_title) $error.="�� ����� ��������� ����<br>";
    if(!$admin_mail) $error.="�� ����� e-mail �������������� ����";
    if(!$error)
      {
      mysql_query("update chat_config set value='$chat_url' where name='chat_url'");
      mysql_query("update chat_config set value='$chat_title' where name='chat_title'");
      mysql_query("update chat_config set value='$admin_mail' where name='admin_mail'");
      $text="
      <form action=index.php?step=5 method=post>
      <input type=hidden name=action value=go>
      <input type=hidden name=admin_mail value=\"$admin_mail\">
      <table border=0 style=\"color: #ffffff\">
      <tr>
      <td>�����:</td>
      <td><input type=text name=login></td>
      </tr>
      <tr>
      <td>������:</td>
      <td><input type=password name=password></td>
      </tr>
      <tr>
      <td>��������� ������:</td>
      <td><input type=password name=confirm_password></td>
      </tr>
      </table>";
      $help="��������� ���������!";
      shield(5,$text,$help,"",0);
      echo "</form>";
      }
    else
      {
      $text="��������� ��������� ������:<br>$error";
      $help="�������� ����� ������ � ������";
      shield(4,$text,$help,"",1);
      }
    }
  else echo"<meta http-equiv='refresh' content='0; url=index.php?step=4'>";
  }

elseif($step==5)
  {
  if($action=="go")
    {
    if($act!=3)
      {
      include("../inc/db.php");
      $dbcnx=@mysql_connect($dblocation,$dbuser,$dbpasswd) or die("<p>� ��������� ������ ������ ���� ������ �� ��������, ������� ���������� ����������� ��������  �����������</p>");
      @mysql_select_db($dbname,$dbcnx) or die("<p>� ��������� ������ ���� ������ ����������, ������� ���������� ����������� �������� ����������.<p>");
      if(!$login) $error.="�� ����� ����� ������<br>";
      if(!$password) $error.="�� ����� ������ ������<br>";
      elseif($password!=$confirm_password) $error.="������ �� ���������";
      }
    if(!$error)
      {
      if($act!=3)
        {
        $password=md5($password);
        mysql_query("INSERT INTO chat_users VALUES (1, '$login', '$password', '999', '$admin_mail', '������� �����', 'orange', 1, 'down', 'down', 'hms','1','russian','1');");  
        }
      $text="��������� ������� <b>\"$script_name\"</b> ���������! ��� ����� � �����. ����� ����������� ��� ����� � ������.
      <span style=\"color: #FF6B6B\"><b>������� ���� inastall/index.php!</b></span> ����� ����� ����� �������������� ������!<br>
      <a href=\"../index.php\">�� �������!</a>";
      $help="��������� ���������!";
      shield(6,$text,$help,"",1);
      }
    else
      {
      $text="��������� ��������� ������:<br>$error";
      $help="�������� ����� ������ � ������";
      shield(5,$text,$help,"",1);
      }
    }
  else echo"<meta http-equiv='refresh' content='0; url=index.php?step=4'>";
  }
else echo"<meta http-equiv='refresh' content='0; url=index.php'>";

include("design/footer.tpl");  
?>