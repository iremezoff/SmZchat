<?
if(!defined("F_MOD"))
  {
  echo "<meta http-equiv='refresh' content='0; url=/index.php'>";
  exit;
  }

session_register("registr_key");

  function form_new_user()
    {
    global $confirm_pass,$type_str;?>
    <script language=JavaScript><!--
    function check(){
    var error  = 1 ;
    <?if($type_str!=1){?>if (form.user_key.value == "") { Mess('Вы не ввели 6-значное число','user_key'); return 0;}<?}?>
    if (form.login.value == "") { Mess('Укажите ваш логин','login'); return 0;}
    if (form.pass.value == "") { Mess('Укажите пароль','pass'); return 0;}
    if (form.confirm_pass.value == "") { Mess('Укажите повторный пароль','confirm_pass'); return 0;}
    if (!checkml (form.mail.value))  {Mess ("Укажите корректный e-mail",'mail');return 0;}
    if (form.about.value == "") { Mess('Укажите информацию о себе','about'); return 0;}
    return error;
    }

    function Mess (mms,str){
    form.elements[str].focus () ;
    alert (mms) ;
    }

    function checkml (str){
    var i ;
    if ((str.indexOf ("@", 0) != -1) && (str.indexOf (".", 0) != -1)){
      i = str.length - str.lastIndexOf (".") - 1 ;
      if (i && (i <= 3) && (str.indexOf ("@", 0) != 0) && ((str.indexOf ("@", 0) + 1) < str.lastIndexOf (".")))
        return 1 ;
    }
    return 0 ;
    }//-->
    </SCRIPT><br>
   <form action="index.php?reg" method="post" name="form">
   <input type="hidden" name="action" value="reg"> 
   <table table cellpadding=3 cellspacing=0 width=100% border=0 class=tb>
   <tr>
   <td width=100% colspan=2><b class=b>Регистрация</b><br>
   Поля, отмеченные * обязательны для заполнения</td>
   </tr>
   <tr>
   <td width=40%>* Логин:<br> </td>
   <td width=60%><input type="text" name="login" size="25"></td>
   </tr>
   <tr>
   <td></td>
   <td class=smallfont>Должен состоять только из букв латинского алфавита и знака _</td>
   </tr>
   <tr>
   <td>* Пароль:<br></td>
   <td><input type="password" name="pass" size="25" maxlength="10"></td>
   </tr>
   <tr>
   <td></td>
   <td class=smallfont>Пароль должен быть длинной не менее 4 и не более 10 символов</td>
   </tr>
   <tr>
   <td>* Повторите пароль: </td>
   <td><input type="password" name="confirm_pass" size="25" maxlength="10"></td>
   </tr>
   <tr>
   <td>* E-mail: </td>
   <td><input type="text" name="mail" size="25"></td>
   </tr>
   <tr>
   <td>&nbsp;&nbsp;Скрыть e-mail: </td>
   <td><input type="radio" name="hidemail" value="1">Да<br><input type="radio" name="hidemail" value="0" checked>Нет</td>
   </tr>
   <tr>
   <td>* О себе: </td>
   <td><textarea name=about cols=50 rows=5></textarea></td>
   </tr>
   <?
   if($type_str!=1){?>
   <tr>
   <td valign=top width=30%>* Введите указанную на картинке строку:</td>
   <td class=smallfont><img src="img.php"><br><input type="text" name="user_key" size="6" maxlength="6"><br>
   Если строка читается неразборчиво, обновите страницу
   </td>
   </tr>
   <?}?>
   <tr>
   <td></td>
   <td><input type="button" value="Регистрация" onClick="if (check()) submit();"></td>
   </tr>
   </table></form><?
    }


function reg_new_user($zn_title)
  {
  global $login,$pass,$confirm_pass,$mail,$hidemail,$about,$realname,$faith,$user_key,$type_str;

  $error="";
  if($type_str!=1 && $user_key!=$_SESSION['registr_key'])      
						$error.="Вы ввели неверное 6-ти значное число<br>";
  if($pass=="")					$error.="Вы не ввели пароль<br>";
  elseif(strlen($pass)<4 or strlen($pass)>10)	$error.="Пароль должен быть от 4 до 10 символов<br>";
  elseif($pass!=$confirm_pass)			$error.="Пароль и повторный пароль не совпадают<br>";
  if(!$login)					$error.="Вы не ввели логин<br>";
  elseif(!eregi('[a-zA-Z0-9_]',$login))
						$error.="Логин может состоять только из латинских букв, цифр и знака _<br>";
  if(!$mail)					$error.="Вы не ввели e-mail<br>";
  elseif(!preg_match("/^[a-zA-Z0-9_]+(([a-zA-Z0-9_.-]+)?)@[a-zA-Z0-9+](([a-zA-Z0-9_.-]+)?)+\.+[a-zA-Z]{2,4}$/",$mail))
						$error.="Вы ввели некорректный e-mail<br>";
  if(!$about)					$error.="Вы не ввели информацию о себе<br>";

  $query_check1=mysql_num_rows(MYSQL_QUERY("SELECT user FROM chat_users WHERE user='$login'"));
  if($query_check1!="0")			$error.="Пользователь с таким логином уже зарегистрирован!<br>";

  $query_check2=mysql_num_rows(MYSQL_QUERY("SELECT mail FROM chat_users WHERE mail='$mail'"));
  if($query_check2!="0")			$error.="Пользователь с таким e-mail уже зарегистрирован!<br>";

  if(empty($error))
    {
    $date=date("Y-m-d");
    $pass_sh=md5($pass);
    $query_reg="INSERT INTO chat_users VALUES('', '$login', '$pass_sh', '0', '$mail', '$about','default','1','down','down','hm','1','russian','$hidemail')";
    if(mysql_query($query_reg))
      {
      $info="Регистрация прошла успешно!";
      echo $info;
      }
    else echo "Произошла ошибка:".mysql_error();
    }
  else
    {
    $url="javascript:history.go(-1)";
    $info="<b>Произошла ошибка!</b><br>$error";
    echo $info;
    }
  }

$title="Регистрация";
include("design/header.tpl");
if(empty($action)) $action="";

if(empty($_SESSION['suser']))
  {
  if($action=="reg")
    {
    reg_new_user($chat_title);
    }
  else
    {
    form_new_user();
    }
  }
else
  {
  $url="index.php";
  $info="Вы уже зарегистрированы!";
  echo $info;
  }
include("design/footer.tpl");
?>