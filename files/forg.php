<?
if(!defined("F_MOD"))
  {
  echo "<meta http-equiv='refresh' content='0; url=/index.php'>";
  exit;
  }

function disp_mail($to,$subject,$message,$admin_mail)
  {
  global $coding_site, $chat_title;
  $from_header="From: $chat_title <$admin_mail>\r\n";
  $from_header.="Content-Type: text/html; charset=$coding_site\n";
  $from_header.="MIME-Version: 1.0\r\n";
  $from_header.="Content-Transfer-Encoding: 8bit\r\n";
  $from_header.="X-Mailer: PHP v.".phpversion();
  if($coding_site==2)
    {
    $to=convert_cyr_string($to,"w","k");
    $subject=convert_cyr_string($subject,"w","k");
    $message=convert_cyr_string($message,"w","k");
    $from_header=convert_cyr_string($from_header,"w","k");
    }
  mail($to,$subject,$message,$from_header);
  }

$title="Восстановление пароля";
include("design/header.tpl");
if(empty($action)) $action="";

if($action=="forget")
  {
  $query_forget=mysql_query("SELECT user, mail FROM chat_users WHERE mail='$mail' and user='$login'") or die(mysql_error());
  $num=mysql_num_rows($query_forget);
  if($num!=0)
    {
    list($login_user, $mail_user)=mysql_fetch_row($query_forget);
    if($login_user==$login)
      {
      $rand_keys=array_rand($array_rand,10);
      $pass_user="";
      for($i=0;$i<10;$i++)
        {
        $pass_user.=$array_rand[$rand_keys[$i]];
        }
      $subject="Восстановление пароля";
      $content="Восстановление пароля<br>";
      $content.="Ваш Логин: $login <br>";
      $content.="Ваш Пароль: $pass_user<br><br>";
      $content.="С уважением, администрация \"$chat_title\"";
      disp_mail($mail_user,$subject,$content,"");
      $pass_user=md5($pass_user);
      $query_upd="update chat_users set pass='$pass_user' where user='$login'";
      if(mysql_query($query_upd))
        {
        echo "На указанный e-mail отправлено письмо с вашим новым паролем";
        }
      }
    else
      {
      echo "Произошла ошибка! Нет соответствий!";
      }
    }
  else
    {
    echo "Произошла ошибка! Нет соответствий!";
    }
  }
else
  {?>
  <script language="JavaScript">
  <!--
  window.moveTo((screen.width-600)/2 , ((screen.height-200)/2)-100);
  //-->
  </script>
  <form action="index.php?forg" method="post">
  <table cellpadding=3 cellspacing=0 width=100% border=0 class=tb>
  <tr>
  <td valign=top><b class=b>Восстановление пароля</b></td>
  </tr>
  <tr>
  <td valign=top>
  Для получения забытого пароля введите Ваш e-mail и логин, указанные при регистрации.
  На E-Mail будет выслано письмо, содержащее ваш новый пароль.</td>
  </tr>
  <tr>
  <td valign=top>
  <input type="hidden" name="action" value="forget">
  Ваш e-mail: <br>
  <input type="text" name="mail" size="20"></td>
  </tr>
  <tr>
  <td valign=top>
  Ваш логин: <br>
  <input type="text" name="login" size="20"></td>
  </tr>
  <tr>
  <td valign=top>
  <input type="submit" value="Принять"></td>
  </tr>
  </table>
  </form><?
  }
include("design/footer.tpl");
?>