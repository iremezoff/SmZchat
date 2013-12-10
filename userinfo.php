<?
define("C_MOD",1);
include("inc/functions.php");

if(empty($mode)) $mode="";
if(empty($act)) $act="";
if($mode=="edit"&&isset($_SESSION['suser']))
  {?>
  <html>
  <head>
  <title><?echo$lang['im'];?> <?echo$_SESSION['suser'];?></title>
  <meta http-equiv="content-type" Content="text/html;charset=windows-1251">
  <link href="design/main.css" type=text/css rel=stylesheet>
  </head>
  <body><?
  if($act=="edit")
    {
    $error="";
    if(!empty($new_pass))
      {
      $ltpass=mysql_result(mysql_query("select pass from chat_users where user='".strtolower($_SESSION['suser'])."'"),0,'pass');
      if(empty($old_pass)) $error.=$lang['error']['oldpass']."<br>";
      elseif($ltpass!=md5($old_pass)) $error.=$lang['error']['oldpass2']."<br>";
      elseif($new_pass!=$confirm_pass) $error.=$lang['error']['passes']."<br>";
      }
    if(empty($mail)) $error.=$lang['error']['mail']."<br>";
    elseif(!preg_match("/^[a-zA-Z0-9_]+(([a-zA-Z0-9_.-]+)?)@[a-zA-Z0-9+](([a-zA-Z0-9_.-]+)?)+\.+[a-zA-Z]{2,4}$/",$mail))
      $error.=$lang['error']['mail2']."<br>";
    if(empty($about)) $error.=$lang['error']['about']."<br>";
    $query_check2=mysql_num_rows(mysql_query("select mail from chat_users where mail='$mail' and user<>'$_SESSION[suser]'"));
    if($query_check2!="0") $error.=$lang['error']['mail3']."<br>";
    if(empty($error))
      {
      $query_edit="update chat_users set mail='$mail',about='$about',hidemail='$hidemail' where user='$_SESSION[suser]'";
      if(mysql_query($query_edit))
        {
        if($new_pass)
          {
          $new_pass=md5($new_pass);
          mysql_query("update chat_users set pass='$new_pass' where user='$_SESSION[suser]'");
          }
        echo "<center>".$lang['complete']['edit']."</center><br>";
        if($_FILES['image']['name'])
          {
          $action=new uploadimg;
          $action->lang=array("complete"=>array($lang['complete']['load']),"error"=>array($lang['error']['ext'],$lang['error']['width'],$lang['error']['height'],$lang['error']['size'],$lang['error']['small'],$lang['error']['copy']));
          $action->check_empty($_FILES['image']['name'],$lang['error']['path']);
          $action->check_empty($_FILES['image']['tmp_name'],$lang['error']['image']);
          $action->check_empty($_FILES['image']['size'],$lang['error']['notfile']);
          if(empty($action->errors))
            {
            $arr=array("photos", "photos/small", "0", $widthmax, $heightmax, $sizemax, "150", "113", $_FILES['image']['tmp_name'],
            $_FILES['image']['name'], round($_FILES['image']['size']/1024));
            list($action->path1, $action->path2, $action->load_small, $action->width_max, $action->height_max,
            $action->size_max, $action->width_to, $action->height_to, $action->image, $action->image_name, $action->size)=$arr;
            $action->setPars();
            $action->check_pars();
            }
          if(empty($action->errors))
            {
            $action->upload();
            echo "<center>$action->total</center>";
            }
          else echo "<center>$action->errors</center>";
          }
        }
      else
        echo "<center>".$lang['complete']['errinfo']."</center>";
      }
    else
      echo "<center>".$lang['complete']['error'].":<br>$error</center>";
    }
  $query_user=mysql_query("select user,mail,about,hidemail from chat_users where user='$_SESSION[suser]'");
  list($user,$mail,$about,$hidemail)=mysql_fetch_row($query_user);?>
  <form action=userinfo.php?mode=edit method=post enctype="multipart/form-data">
  <input type=hidden name=act value=edit>
  <table cellpadding=1 cellspacing=3 width=100% border=0 align=center>
  <tr>
  <td colspan=2 class=tcat><h3><?echo$lang['edit'];?></h3></td>
  </tr>
  <tr>
  <td valign=top class=tcat><?echo$lang['user'];?>:</td>
  <td class=alt2><?echo$user;?></td>
  </tr>
  <tr>
  <td valign=top class=tcat><?echo$lang['oldpass'];?>:</td>
  <td class=alt2><input type=password name=old_pass></td>
  </tr>
  <tr>
  <td valign=top class=tcat><?echo$lang['newpass'];?>:</td>
  <td class=alt2><input type=password name=new_pass></td>
  </tr>
  <tr>
  <td valign=top class=tcat><?echo$lang['confpass'];?>:</td>
  <td class=alt2><input type=password name=confirm_pass></td>
  </tr>
  <tr>
  <td valign=top class=tcat><?echo$lang['email'];?>:</td>
  <td class=alt2><input type=text name=mail value="<?echo$mail;?>"></a></td>
  </tr>
  <tr>
  <td valign=top class=tcat>&nbsp;&nbsp;<?echo$lang['hidemail'];?>: </td>
  <td class=alt2><input type="radio" name="hidemail" value="1"<?if($hidemail==1)echo" checked";?>>Да<br><input type="radio" name="hidemail" value="0"<?if($hidemail==0)echo" checked";?>>Нет</td>
  </tr>
  <tr>
  <td valign=top class=tcat><?echo$lang['about'];?>:</td>
  <td class=alt2><textarea name=about cols=40 rows=5 class=smallfont><?echo$about;?></textarea></td>
  </tr>
  <tr>
  <td valign=top class=tcat><?echo$lang['photo'];?>:<br></td>
  <td class=alt2><input type=file name=image></td>
  </tr>
  <tr>
  <td valign=top class=alt2 colspan=2><b><?echo$lang['actphoto'];?>:</b><br><?
  $user=strtolower($_SESSION['suser']);
  if(file_exists("photos/$user.jpg")) echo "<img src=\"photos/$user.jpg\">";
  elseif(file_exists("photos/$user.gif")) echo "<img src=\"photos/$user.gif\">";
  elseif(file_exists("photos/$user.png")) echo "<img src=\"photos/$user.png\">";
  else echo $lang['notfound'];
  ?></td>
  </tr>
  <tr>
  <td colspan=2 class=tcat align=center><input type=submit value="<?echo$lang['edit2'];?>"></td>
  </tr>
  </table></form>
  </body></html><?
  }
else
  {
  $query_user=mysql_query("select user,balls,mail,about,hidemail from chat_users where user='$user'");
  if(mysql_num_rows($query_user)>0)
    {
    list($user,$balls,$mail,$about,$hidemail)=mysql_fetch_row($query_user);
    if($balls>=500&&$balls<700)
      $status="<img src=\"theme/$skin/icons/moder.gif\" width=16 height=16>$lang[moderator2]";
    if($balls>=700&&$balls<999)
      $status="<img src=\"theme/$skin/icons/moder2.gif\" width=16 height=16>$lang[moderator1]";
    elseif($balls==999)
      $status="<img src=\"theme/$skin/icons/admin.gif\" width=16 height=16>$lang[administrator]";
    else
      $status="<img src=\"theme/$skin/icons/user.gif\" width=16 height=16>$lang[user]";?>
    <html>
    <head>
    <title><?echo$lang['aboutuser'];?> <?echo$user;?></title>
    <meta http-equiv="content-type" Content="text/html;charset=windows-1251">
    <link href="design/main.css" type=text/css rel=stylesheet>
    </head>
    <body>
    <table cellpadding=1 cellspacing=3 width=100% border=0 align=center>
    <tr>
    <td colspan=2 class=tcat><h3><?echo$lang['info'];?></h3></td>
    </tr>
    <tr>
    <td valign=top class=tcat><?echo$lang['user'];?>:</td>
    <td class=alt2><?echo$user;?></td>
    </tr>
    <tr>
    <td valign=top class=tcat><?echo$lang['status'];?>:</td>
    <td class=alt2><?echo$status;?></td>
    </tr>
    <tr>
    <td valign=top class=tcat><?echo$lang['email'];?>:</td>
    <td class=alt2><?if($hidemail==1) echo"<скрыто>";else{?><a href="mailto:<?echo$mail;?>"><?echo$mail;?></a><?}?></td>
    </tr>
    <tr>
    <td valign=top class=tcat><?echo$lang['about'];?>:</td>
    <td class=alt2><?echo$about;?></td>
    </tr>
    <tr>
    <td valign=top class=alt2 colspan=2><b><?echo$lang['photo'];?>:</b><br><?
    $user=strtolower($user);
    if(file_exists("photos/$user.jpg")) echo "<img src=\"photos/$user.jpg\">";
    elseif(file_exists("photos/$user.gif")) echo "<img src=\"photos/$user.gif\">";
    elseif(file_exists("photos/$user.png")) echo "<img src=\"photos/$user.png\">";
    else echo $lang['notfound'];
    ?></td>
    </tr>
    <tr>
    <td colspan=2 class=tcat>&nbsp;</td>
    </tr>
    </table>
    </body></html><?
    }
  else
    {
    echo "<html><head></head><body><script language=javascript>window.close();</script></body></html>";
    }
  }
?>