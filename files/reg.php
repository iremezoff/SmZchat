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
    <?if($type_str!=1){?>if (form.user_key.value == "") { Mess('�� �� ����� 6-������� �����','user_key'); return 0;}<?}?>
    if (form.login.value == "") { Mess('������� ��� �����','login'); return 0;}
    if (form.pass.value == "") { Mess('������� ������','pass'); return 0;}
    if (form.confirm_pass.value == "") { Mess('������� ��������� ������','confirm_pass'); return 0;}
    if (!checkml (form.mail.value))  {Mess ("������� ���������� e-mail",'mail');return 0;}
    if (form.about.value == "") { Mess('������� ���������� � ����','about'); return 0;}
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
   <td width=100% colspan=2><b class=b>�����������</b><br>
   ����, ���������� * ����������� ��� ����������</td>
   </tr>
   <tr>
   <td width=40%>* �����:<br> </td>
   <td width=60%><input type="text" name="login" size="25"></td>
   </tr>
   <tr>
   <td></td>
   <td class=smallfont>������ �������� ������ �� ���� ���������� �������� � ����� _</td>
   </tr>
   <tr>
   <td>* ������:<br></td>
   <td><input type="password" name="pass" size="25" maxlength="10"></td>
   </tr>
   <tr>
   <td></td>
   <td class=smallfont>������ ������ ���� ������� �� ����� 4 � �� ����� 10 ��������</td>
   </tr>
   <tr>
   <td>* ��������� ������: </td>
   <td><input type="password" name="confirm_pass" size="25" maxlength="10"></td>
   </tr>
   <tr>
   <td>* E-mail: </td>
   <td><input type="text" name="mail" size="25"></td>
   </tr>
   <tr>
   <td>&nbsp;&nbsp;������ e-mail: </td>
   <td><input type="radio" name="hidemail" value="1">��<br><input type="radio" name="hidemail" value="0" checked>���</td>
   </tr>
   <tr>
   <td>* � ����: </td>
   <td><textarea name=about cols=50 rows=5></textarea></td>
   </tr>
   <?
   if($type_str!=1){?>
   <tr>
   <td valign=top width=30%>* ������� ��������� �� �������� ������:</td>
   <td class=smallfont><img src="img.php"><br><input type="text" name="user_key" size="6" maxlength="6"><br>
   ���� ������ �������� ������������, �������� ��������
   </td>
   </tr>
   <?}?>
   <tr>
   <td></td>
   <td><input type="button" value="�����������" onClick="if (check()) submit();"></td>
   </tr>
   </table></form><?
    }


function reg_new_user($zn_title)
  {
  global $login,$pass,$confirm_pass,$mail,$hidemail,$about,$realname,$faith,$user_key,$type_str;

  $error="";
  if($type_str!=1 && $user_key!=$_SESSION['registr_key'])      
						$error.="�� ����� �������� 6-�� ������� �����<br>";
  if($pass=="")					$error.="�� �� ����� ������<br>";
  elseif(strlen($pass)<4 or strlen($pass)>10)	$error.="������ ������ ���� �� 4 �� 10 ��������<br>";
  elseif($pass!=$confirm_pass)			$error.="������ � ��������� ������ �� ���������<br>";
  if(!$login)					$error.="�� �� ����� �����<br>";
  elseif(!eregi('[a-zA-Z0-9_]',$login))
						$error.="����� ����� �������� ������ �� ��������� ����, ���� � ����� _<br>";
  if(!$mail)					$error.="�� �� ����� e-mail<br>";
  elseif(!preg_match("/^[a-zA-Z0-9_]+(([a-zA-Z0-9_.-]+)?)@[a-zA-Z0-9+](([a-zA-Z0-9_.-]+)?)+\.+[a-zA-Z]{2,4}$/",$mail))
						$error.="�� ����� ������������ e-mail<br>";
  if(!$about)					$error.="�� �� ����� ���������� � ����<br>";

  $query_check1=mysql_num_rows(MYSQL_QUERY("SELECT user FROM chat_users WHERE user='$login'"));
  if($query_check1!="0")			$error.="������������ � ����� ������� ��� ���������������!<br>";

  $query_check2=mysql_num_rows(MYSQL_QUERY("SELECT mail FROM chat_users WHERE mail='$mail'"));
  if($query_check2!="0")			$error.="������������ � ����� e-mail ��� ���������������!<br>";

  if(empty($error))
    {
    $date=date("Y-m-d");
    $pass_sh=md5($pass);
    $query_reg="INSERT INTO chat_users VALUES('', '$login', '$pass_sh', '0', '$mail', '$about','default','1','down','down','hm','1','russian','$hidemail')";
    if(mysql_query($query_reg))
      {
      $info="����������� ������ �������!";
      echo $info;
      }
    else echo "��������� ������:".mysql_error();
    }
  else
    {
    $url="javascript:history.go(-1)";
    $info="<b>��������� ������!</b><br>$error";
    echo $info;
    }
  }

$title="�����������";
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
  $info="�� ��� ����������������!";
  echo $info;
  }
include("design/footer.tpl");
?>