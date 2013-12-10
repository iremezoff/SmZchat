<?
define("C_MOD",1);
include("inc/functions.php");

$title="Панель администрирования";
include("design/header.tpl");

if($_SESSION['balls']>=700)
  {
  echo "
  <table cellpadding=0 cellspacing=0 width=100% border=0>
  <tr>
  <td align=center>[ <a href=\"adm.php?mode=rules\">Редактирование правил</a> ]</td>
  <td align=center>[ <a href=\"adm.php?mode=smiles\">Редактирование смайлов</a> ]</td>";
  if($_SESSION['balls']==999)
  echo "
  <td align=center>[ <a href=\"adm.php?mode=balls\">Редактирование баллов</a> ]</td>
  <td align=center>[ <a href=\"adm.php?mode=rooms\">Редактирование комнат</a> ]</td>
  <td align=center>[ <a href=\"adm.php?mode=compl\">Смотреть жалобы</a> ]</td>
  <td align=center>[ <a href=\"adm.php?mode=langs\">Языки</a> ]</td>
  <td align=center>[ <a href=\"adm.php?mode=reg\">Строка регистрации</a> ]</td>
  <td align=center>[ <a href=\"adm.php?mode=dump\">Дамп БД</a> ]</td>
  <td align=center>[ <a href=\"adm.php\">Опции</a> ]</td>";
  echo "</tr>
  </table>
  <hr width=100% size=2 color=#000000>
  <a href=\"javascript:history.go(-1)\"><b>&laquo; Назад</b></a><br>";
  }

if(empty($mode)&&$_SESSION['balls']>=700&&$_SESSION['balls']<999) $mode="rules";
elseif(empty($mode)&&$_SESSION['balls']==999) $mode="";
if(empty($act)) $act="";
if(empty($operat)) $operat="";
if(empty($page)) $page=1;

if($mode=="rules"&&$_SESSION['balls']>=700)
  {
  if(isset($editrs))
    {
    if(count($rules)>0)
      {
      foreach($rules as $key=>$val)
        {
        foreach($val as $key2=>$val2)
          {
          if(!empty($val2)) mysql_query("update chat_rules set content='$val2' where id='$key2'");
          else mysql_query("delete from chat_rules where id='$key2'");
          }
        }
      foreach($rules_cats as $key2=>$val2)
        {
        if($val2) mysql_query("update chat_rules_cats set categ='$val2' where id='$key2'");
        elseif(!$val2)
          {
          mysql_query("delete from chat_rules where id_cat='$key2'");
          mysql_query("delete from chat_rules_cats where id='$key2'");
          }
        }
      echo "Правила успешно отредактированы";
      }
    else
      {
      echo "Не определенно ни одного правила";
      }
    }
  elseif(isset($addrule))
    {
    $count=0;
    foreach($newrule as $key=>$val)
      {
      if($val) {$count++;$val2=$val;$key2=$key;}
      }
    if($count<1) $error.="Вы не ввели содержание нового правила";
    if(empty($error))
      {
      $query_newrule="insert into chat_rules values ('','$key2','$val2')";
      if(mysql_query($query_newrule))
        {
        echo "Правило успешно добавлено в базу!";
        }
      }
    else
      {
      echo "Произошла ошибка!<br>$error";
      }
    }
  elseif(isset($addcat))
    {
    if(!$newcat) $error.="Вы не ввели название новой категории";
    if(empty($error))
      {
      $query_newcat="insert into chat_rules_cats values ('','$newcat')";
      if(mysql_query($query_newcat))
        {
        echo "Новая категория успешно добавлена в базу!";
        }
      }
    else
      {
      echo "Произошла ошибка!<br>$error";
      }
    }
  else
    {
    $query_cats=mysql_query("select * from chat_rules_cats order by id");?>
    <table width="100%" cellspacing="0" cellpadding="0" border="0">
    <tr>
    <td colspan="2" height="25" align="right" nowrap="nowrap">
    <span class=big><i>&raquo Редактирование правил</i></span></td>
    </tr>
    </table>
    <span class=smallfont>* <b>Оставьте поле пустым, если хотите удалить правило или категорию правил</b></span>
    <form action=adm.php?mode=rules method=post>
    <table cellpadding=1 cellspacing=3 width=100% border=0>
    <tr>
    <td valign=top class=tcat align=center>Редактирование правил</td>
    </tr><?
    while($array_cats=mysql_fetch_array($query_cats))
      {
      echo "<tr>
      <td valign=top class=tcat align=center>
      <b><input type=text name=rules_cats[$array_cats[id]] value=\"$array_cats[categ]\" size=50></b></td>
      </tr>
      <tr>
      <td valign=top class=alt2><ol>";
      $query_rules=mysql_query("select * from chat_rules where id_cat='$array_cats[id]' order by id");
      while($array_rules=mysql_fetch_array($query_rules))
        {
        echo "<li><input type=text name=rules[$array_cats[id]][$array_rules[id]] class=smallfont value=\"$array_rules[content]\" size=100></li>";
        }
      echo "<br>Новове правило: <input type=text name=newrule[$array_cats[id]] class=smallfont soze=100></textarea>
      <input type=submit name=addrule value=\"Добавить!\" class=smallfont>
      </td>
      </tr>
      <tr><td class=tcat><hr width=80%></td></tr>";
      }?>
    <tr><td>&nbsp;</td></tr>
    <tr>
    <td valign=top class=tcat align=center><br>
    <input type=submit name=editrs value="Обновить правила"><br><br></td>
    </tr>
    <tr><td>&nbsp;</td></tr>
    <tr>
    <td valign=top class=tcat>
    Новая категория: <input type=text name=newcat size=25> <input type=submit name=addcat value="Добавить">
    </table></form><?
    }
  }
elseif($mode=="smiles"&&$_SESSION['balls']>=700)
  {
  if(empty($operat)) $operat="";
  if(empty($act)) $act="";
  if(isset($add))
    {
    $error="";
    if(!$smile_code) $error.="Не указан код смайлика!";
    if(empty($error))
      {
      $query_add="INSERT INTO chat_smiles VALUES ('','$smile_code','$smile_url')";
      if(mysql_query($query_add))
        {
        echo "Смайлик успешно добавлен в базу!";
        }
      else 
        {
        echo "Произошла ошибка при добавлении смайлика в базу! Возможно, такой код уже существует.";
        }
      }
    else 
      {
      echo "Произошла ошибка!<br>$error";
      }
    }
  elseif(isset($edit))
    {
    $error="";
    if(empty($smile_code)) $error.="Не указан код смайлика!";
    if(empty($error))
      {
      $query_upd="update chat_smiles set code='$smile_code', url='$smile_url' where id='$id'";
      if(mysql_query($query_upd))
        {
        echo "Смайлик успешно отредактирован!";
        }
      else 
        {
        echo "Произошла ошибка при редактировании смайлика в базе!";
        }
      }
    else 
      {
      echo "Произошла ошибка!<br>$error";
      }
    }
  elseif($operat=="del")
    {      
    $query_del="delete from chat_smiles where id='$id'";
    if(mysql_query($query_del))
      {
      echo "Смайлик успешно удалён!";
      }
    else 
      {
      echo "Произошла ошибка при удалении смайлика из базы!";
      }
    }      
  else
    {
    if($act=="add")
      {?>
      <script language="javascript" type="text/javascript">
      <!--
      function update_smiley(newimage)
        {
	document.smiley_image.src = "smiles/" + newimage;
        }
      //-->
      </script>
      <table width="100%" cellspacing="0" cellpadding="0" border="0">
      <tr>
      <td colspan="2" height="25" align="right" nowrap="nowrap">
      <span class=big><i>&raquo Управление смайликами</i></span></td>
      </tr>
      </table>
      <form action=adm.php?mode=smiles method=post>
      <table cellpadding=1 cellspacing=3 width=100% border=0 align=center>
      <tr>
      <td valign=top align=center class=tcat colspan=2>Добавление смайлика</td>
      </tr>
      <tr>
      <td valign=top class=alt2 width=50%>Код смайлика</td>
      <td valign=top class=alt2 width=50%>
      <input type=text name=smile_code size=25></td>
      </tr>
      <tr>
      <td class=alt2 width=50%>Файл с изображением смайлика</td>
      <td class=alt2 width=50%>
      <select name=smile_url onchange="update_smiley(this.options[selectedIndex].value);" class=smallfont><?
      $dir=opendir("smiles");
      while($file=readdir($dir))
        {
        list($name_img,$perm)=explode(".",$file);
        if($file!="." && $file!=".." && $perm=="gif")
          {
          if(empty($sm_n)) $sm_n=$file;
          $opt="<option value=\"$file\" >".$file."</option>\r\n";
          echo $opt;
          }
        }?>
      </select> <img name="smiley_image" src="smiles/<?echo$sm_n;?>" border="0"></td>
      </tr>
      <tr>
      <td colspan=2 class=tcat width=100% align=center>
      <input type=submit name=add value="Добавить"></td>
      </tr>
      </table></form><?         
      }
    elseif($act=="edit")
      {
      $query_smile=mysql_query("select * from chat_smiles where id='$id';");
      list($id_sm,$smile_code,$smile_url)=mysql_fetch_row($query_smile);?>
      <script language="javascript" type="text/javascript">
      <!--
      function update_smiley(newimage)
        {
	document.smiley_image.src = "smiles/" + newimage;
        }
      //-->
      </script>
      <table width="100%" cellspacing="0" cellpadding="0" border="0">
      <tr>
      <td colspan="2" height="25" align="right" nowrap="nowrap">
      <span class=big><i>&raquo Управление смайликами</i></span></td>
      </tr>
      </table>
      <form action=adm.php?mode=smiles method=post>
      <input type=hidden name=id value="<?echo$id_sm;?>">
      <table cellpadding=1 cellspacing=3 width=100% border=0 align=center>
      <tr>
      <td valign=top align=center class=tcat colspan=2>Редактирование смайлика</td>
      </tr>
      <tr>
      <td valign=top class=alt2 width=50%>Код смайлика</td>
      <td valign=top class=alt2 width=50%>
      <input type=text name=smile_code value="<?echo$smile_code;?>" size=25></td>
      </tr>
      <tr>
      <td class=alt2 width=50%>Файл с изображением смайлика</td>
      <td class=alt2 width=50%>
      <select name=smile_url onchange="update_smiley(this.options[selectedIndex].value);" class=smallfont><?
      $dir=opendir("smiles");
      while($file=readdir($dir))
        {
        list($name_img,$perm)=explode(".",$file);
        if($file!="." && $file!=".." && $perm=="gif")
          {
          if(empty($sm_n)) $sm_n=$file;
          $opt="\r\n<option value=\"$file\"";
          if($smile_url==$file) $opt.=" selected";
          $opt.=">".$file."</option>";
          echo $opt;
          }
        }?>
      </select> <img name="smiley_image" src="smiles/<?echo$sm_n;?>" border="0"></td>
      </tr>
      <tr>
      <td colspan=2 class=tcat width=100% align=center>
      <input type=submit name=edit value="Изменить"></td>
      </tr>
      </table></form><?         
      }
    else
      {
      $query_smiles=mysql_query("select * from chat_smiles order by id;");?>
      <table width="100%" cellspacing="0" cellpadding="0" border="0">
      <tr>
      <td colspan="2" height="25" align="right" nowrap="nowrap">
      <span class=big><i>&raquo Управление смайликами</i></span></td>
      </tr>
      </table>
      <table cellpadding=1 cellspacing=3 width=100% border=0 align=center>
      <tr>
      <td align=center colspan=4>
      <a href="adm.php?mode=smiles&act=add">Добавление смайлика</a></td>
      </tr>
      <tr>
      <td valign=top align=center class=tcat colspan=4>Управление смайликами</td>
      </tr>
      <tr>
      <td align=center class=tcat width=20%><b>Код смайлика</b></td>
      <td align=center class=tcat width=20%><b>Изображение смайлика</b></td>
      <td align=center class=tcat width=30%><b>Файл с изображением смайлика</b></td>
      <td align=center class=tcat width=30%><b>Действие</b></td>
      </tr><?
      while($array_smiles=mysql_fetch_array($query_smiles))
        {
        $id_smile=$array_smiles['id'];
        $smile_code=$array_smiles['code'];
        $smile_url=$array_smiles['url'];?>
        <tr>
        <td align=center class=alt2 width=20%><b><?echo$smile_code;?></b></td>
        <td align=center class=alt2 width=20%><img src="smiles/<?echo$smile_url;?>"></td>
        <td align=center class=alt2 width=30%><?echo$smile_url;?></td>
        <td align=center class=alt2 width=30% ><a href="adm.php?mode=smiles&act=edit&id=<?echo$id_smile;?>">Изменить</a>
        <a href="adm.php?mode=smiles&operat=del&&id=<?echo$id_smile;?>"
        onClick="return confirm('Вы действительно хотите удалить этот смайлик?');">Удалить</a></td>
        </tr><?         
        }?>
      </table><?
      }
    }
  }
elseif($mode=="balls"&&$_SESSION['balls']==999)
  {
  if(isset($edit))
    {
    $error="";
    if(empty($setuser)) $error.="Не указан пользователь.<br>";
    if(empty($setballs)&&$setballs!="0") $error.="Не указаны баллы.<br>";
    if(empty($error))
      {
      $query_edit="update chat_users set balls='$setballs' where user='$setuser'";
      if(mysql_query($query_edit))
        {
        echo "Баллы успешно отредактированы.";
        }
      else
        {
        echo "Произошла ошибка при редактировании баллов.";
        }
      }
    else 
      {
      echo "Произошла ошибка!<br>$error";
      }
    }
  elseif($operat=="del")
    {
    $check=mysql_result(mysql_query("select id from chat_users where user='$_SESSION[suser]'"),0,'id');
    if($check!=$id)
      $query_del="update chat_users set balls='0' where id='$id'";
    else $query_del="";
    if(mysql_query($query_del))
      {
      echo "Баллы успешно удалены!";
      }
    else 
      {
      echo "Произошла ошибка при удалении баллов из базы!";
      }
    }
  else
    {
    $count=mysql_result(mysql_query("select count(*) from chat_users where balls>0"),0,'count(*)');
    $pages=ceil($count/20);
    if($page=="" or $page=="0") $lim="0";
    else $lim=($page-1)*20;
    $query_balls=mysql_query("select * from chat_users where balls>0 order by balls desc, id limit $lim,20");?>
    <table width="100%" cellspacing="0" cellpadding="0" border="0">
    <tr>
    <td colspan="2" height="25" align="right" nowrap="nowrap">
    <span class=big><i>&raquo Управление баллами</i></span></td>
    </tr>
    </table>
    <table cellpadding=1 cellspacing=3 width=100% border=0 align=center>
    <tr>
    <td valign=top align=center class=tcat colspan=4>Управление баллами</td>
    </tr>
    <tr>
    <td align=center class=tcat width=30%><b>Пользователь</b></td>
    <td align=center class=tcat width=30%><b>Баллы</b></td>
    <td align=center class=tcat width=40%><b>Действие</b></td>
    </tr>
    <tr>
    <td class=alt2 colspan=3><span class=smallfont>Всего: <b><?echo$pages;?></b>. Страницы: <b><?pages($count);?></b></span></td>
    </tr><?
    while($array_balls=mysql_fetch_array($query_balls))
      {
      echo "<tr>
      <td align=center class=alt2 width=20%><b>$array_balls[user]</b></td>
      <td align=center class=alt2 width=20%>$array_balls[balls]</td>
      <td align=center class=alt2 width=30%>
      <a href=\"adm.php?mode=balls&operat=del&&id=$array_balls[id]\"
      onClick=\"return confirm('Вы действительно хотите удалить баллы этого пользователя?');\">Удалить баллы</a></td>
      </tr>";
      }
    echo "<tr>
    <td colspan=3 class=tcat><form action=adm.php?mode=balls method=post>
    Изменить баллы:
    Пользователь: <input type=text name=setuser> Баллы: <input type=text name=setballs maxlength=3>
    <input type=submit name=edit value=\"Изменить\"></form></td></tr>";
    echo "</table>";
    }
  }
elseif($mode=="rooms"&&$_SESSION['balls']==999)
  {
  if(isset($add))
    {
    $error="";
    if(empty($newroom)) $error.="Не указано название комнаты!<br>";
    if(empty($newbot)) $error.="Не указано имя бота!<br>";
    if(empty($error))
      {
      $query_add="insert into chat_rooms values('','$newroom','$newbot')";
      if(mysql_query($query_add))
        {
        echo "Комната успешно добавлена!";
        }
      else
        {
        echo "Произошла ошибка при добавлении комнаты!";
        }
      }
    else
      {
      echo "Произошла ошибка!<br>$error";
      }
    }
  elseif(isset($edit))
    {
    $error="";
    if(empty($setroom)) $error.="Не введено название комнаты!<br>";
    if(empty($setbot)) $error.="Не введено имя бота!<br>";
    if(empty($error))
      {
      $query_edit="update chat_rooms set name='$setroom',botname='$setbot' where id='$id_room'";
      if(mysql_query($query_edit))
        {
        echo "Комната успешно отредактирована!";
        }
      else
        {
        echo "Произошла ошибка при редактировании комнаты!";
        }
      }
    else
      {
      echo "Произошла ошибка!<br>$error";
      }
    }
  elseif($operat=="del")
    {
    $query_del="delete from chat_rooms where id='$id'";
    if(mysql_query($query_del))
      {
      mysql_query("delete from chat_messages where room='$id'");
      $min_room=mysql_result(mysql_query("select min(id) from chat_rooms"),0,'min(id)');
      mysql_query("update chat_onliners set room='$min_room'");
      echo "Комната успешно удалена";
      }
    else
      {
      echo "Произошла ошибка при удалении комнаты";
      }
    }
  else
    {
    if($act=="edit")
      {
      $query_room=mysql_query("select * from chat_rooms where id='$id'");
      list($id_room,$name_room,$name_bot)=mysql_fetch_row($query_room);?>
      <table width="100%" cellspacing="0" cellpadding="0" border="0">
      <tr>
      <td colspan="2" height="25" align="right" nowrap="nowrap">
      <span class=big><i>&raquo Редактирование комнат</i></span></td>
      </tr>
      </table>
      <form action=adm.php?mode=rooms method=post>
      <input type=hidden name=id_room value=<?echo$id_room;?>>
      <table cellpadding=1 cellspacing=3 width=100% border=0>
      <tr>
      <td align=center class=tcat colspan=2>Редактирование комнаты</td>
      </tr>
      <tr>
      <td class=alt2 width=20%><b>Название комнаты:</b></td>
      <td class=alt2 width=80%><input type=text name=setroom value="<?echo$name_room;?>"></td>
      </tr>
      <tr>
      <td class=alt2 width=20%><b>Имя бота:</b></td>
      <td class=alt2 width=80%><input type=text name=setbot value="<?echo$name_bot;?>"></td>
      </tr>
      <tr>
      <td align=center class=tcat colspan=2><input type=submit name=edit value="Редактировать"></td>
      </tr>
      </table></form><?
      }
    else
      {
      $query_rooms=mysql_query("select * from chat_rooms order by id");?>
      <table width="100%" cellspacing="0" cellpadding="0" border="0">
      <tr>
      <td colspan="2" height="25" align="right" nowrap="nowrap">
      <span class=big><i>&raquo Редактирование комнат</i></span></td>
      </tr>
      </table>
      <table cellpadding=1 cellspacing=3 width=100% border=0>
      <tr>
      <td valign=top class=tcat align=center>#</td>
      <td valign=top class=tcat align=center>Комнаты</td>
      <td valign=top class=tcat align=center>Боты</td>
      <td valign=top class=tcat align=center>Действия</td>
      </tr><?
      $r=1;
      while($array_rooms=mysql_fetch_array($query_rooms))
        {?>
        <tr>
        <td align=center class=alt2><?echo$r;?></td>
        <td align=center class=alt2><b><?echo$array_rooms['name'];?></b></td>
        <td align=center class=alt2><b><?echo$array_rooms['botname'];?></b></td>
        <td align=center class=alt2><a href="adm.php?mode=rooms&act=edit&id=<?echo$array_rooms['id'];?>">Редактировать</a> |
        <a href="adm.php?mode=rooms&operat=del&id=<?echo$array_rooms['id'];?>"
        onClick="return confirm('Вы действительно хотите удалить эту комнату?');">Удалить</a></td>
        </tr><?
        $r++;
        }?>
      <tr>
      <td valign=top colspan=4 class=tcat>
      <form action=adm.php?mode=rooms method=post>
      Добавить новую комнату: Название: <input type=text name=newroom> Бот: <input type=text name=newbot> <input type=submit name=add value="Добавить!">
      </from></td>
      </tr>
      </table><?
      }
    }
  }
elseif($mode=="compl"&&$_SESSION['balls']==999)
  {
  $count=mysql_result(mysql_query("select count(*) from chat_compl"),0,'count(*)');
  $pages=ceil($count/20);
  if($page=="" or $page=="0") $lim="0";
  else $lim=($page-1)*20;
  $query_compl=mysql_query("select * from chat_compl order by time desc limit $lim,20");?>
  <table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tr>
  <td colspan="2" height="25" align="right" nowrap="nowrap">
  <span class=big><i>&raquo Жалобы на модеров</i></span></td>
  </tr>
  </table>
  <table cellpadding=1 cellspacing=3 width=100% border=0 align=center>
  <tr>
  <td valign=top align=center class=tcat colspan=4>Жалобы на модеров</td>
  </tr>
  <tr>
  <td align=center class=tcat width=20%><b>Пользователь</b></td>
  <td align=center class=tcat width=20%><b>Модератор</b></td>
  <td align=center class=tcat width=20%><b>Дата</b></td>
  <td align=center class=tcat width=40%><b>Текст</b></td>
  </tr>
  <tr>
  <td class=alt2 colspan=4><span class=smallfont>Всего: <b><?echo$count;?></b>. Страницы: <b><?pages($count);?></b></span></td>
  </tr><?
  while($array_compl=mysql_fetch_array($query_compl))
    {
    $date=date("d.m.Y H:i:s",$array_compl['time']);
    echo "<tr>
    <td align=center class=alt2><b>$array_compl[user]</b></td>
    <td align=center class=alt2>$array_compl[moder]</td>
    <td align=center class=alt2>$date</td>
    <td align=center class=alt2><span class=smallfont>$array_compl[text]</span></td>
    </tr>";
    }
  echo "</table>";
  }
elseif($mode=="langs"&&$_SESSION['balls']==999)
  {
  if(isset($add)&&isset($nlang))
    {
    $sqls=0;
    $lang=array();
    include("langs/$_POST[nlang].lng");
    if($_POST['type']==2) mysql_query("delete from chat_language where lang='$_POST[nlang]'");
    foreach($lang as $key=>$val)
      {
      if(is_array($lang[$key]))
        {
        foreach($lang[$key] as $key2=>$val2)
          {
          $query_check=mysql_query("select id from chat_language where descr='".mysql_escape_string($key)."|".mysql_escape_string($key2)."' and lang='$_POST[nlang]'");
          if(mysql_num_rows($query_check)<1)
            {
            mysql_query("insert into chat_language values ('','".mysql_escape_string($key)."|".mysql_escape_string($key2)."','".mysql_escape_string($val2)."','$_POST[nlang]')");
            $sqls++;
            }
          }      
        }
      else
        {
        $query_check=mysql_query("select id from chat_language where descr='".mysql_escape_string($key)."' and lang='$_POST[nlang]'");
        if(mysql_num_rows($query_check)<1)
          {
          mysql_query("insert into chat_language values ('','".mysql_escape_string($key)."','".mysql_escape_string($val)."','$_POST[nlang]')");
          $sqls++;
          }
        }
      }
    echo "Язык успешно добавлен<br>Всего добавлено: $sqls";
    }
  elseif($act=="del"&&$id)
    {
    $query_del="delete from chat_language where lang='$id'";
    if(mysql_query($query_del))
      {
      mysql_query("update chat_users set lang='russian' where lang='$id'");
      mysql_query("delete from chat_onliners where lang='$id'");      
      echo "Язык успешно удалён";
      }
    else
      {
      echo "Произошла ошибка при удалении языка";
      }
    }
  else
    {
    if($act=="add")
      {?>
      <table width="100%" cellspacing="0" cellpadding="0" border="0">
      <tr>
      <td colspan="2" height="25" align="right" nowrap="nowrap">
      <span class=big><i>&raquo Добавление/обновление языков</i></span></td>
      </tr>
      </table>
      <form action=adm.php?mode=langs method=post name=form>
      <table cellpadding=1 cellspacing=3 width=100% border=0>
      <tr>
      <td class=tcat width=60%><span class=smallfont><b>Устанавливаемый язык</b></span></td>
      <td class=alt2 width=40%><select name=nlang class=smallfont><?
      $open=opendir("./langs");
      while($lng_f=readdir($open))
        {
        if(preg_match("|([a-z]+).lng|is",$lng_f,$arr))
          {
          echo "<option value=\"$arr[1]\">$arr[1]</option>\r\n";
          }
        }?>
      </select></td>
      </tr>
      <tr>
      <td class=tcat width=60%><span class=smallfont><b>Тип установки</b></span></td>
      <td class=alt2 width=40%><span class=smallfont>
      <input type=radio name=type value=1 checked> Обновление (добавление новых элементов)<br>
      <input type=radio name=type value=2> Переустановка (полная замена старых элементов и добавление новых)</span></td>
      </tr>
      <tr>
      <td class=tcat colspan=2 align=center><input type=submit name=add value="Добавить"></td>
      </tr>
      </table>
      </form><?
      }
    else
      {
      $query_langs=mysql_query("select lang from chat_language group by lang");?>
      <table width="100%" cellspacing="0" cellpadding="0" border="0">
      <tr>
      <td colspan="2" height="25" align="right" nowrap="nowrap">
      <span class=big><i>&raquo Языки</i></span></td>
      </tr>
      </table>
      <table cellpadding=1 cellspacing=3 width=100% border=0>
      <tr>
      <td colspan=2 align=center><a href="adm.php?mode=langs&act=add">добавление/обновление языков</a></td>
      </tr>
      <tr>
      <td class=tcat width=60% align=center>Язык</td>
      <td class=tcat width=40% align=center>Действие</td>
      </tr><?
      while($arr_langs=mysql_fetch_array($query_langs))
        {
        echo "<tr>";
        echo "<td class=alt2 align=center><b>$arr_langs[lang]</b></td>";
        echo "<td class=alt2 align=center>";
        if($arr_langs['lang']!="russian") echo "<a href=\"adm.php?mode=langs&act=del&id=$arr_langs[lang]\" 
        onClick=\"return confirm('Вы действительно хотите удалить этот язык? Будьте внимательны, удаление языка может привести к ошибкам в работе чата у пользователей, использующих данный язык в настоящее время');\">удалить</a>";
        echo "</td>";
        echo "</tr>";
        }
      echo "</table>";
      }
    }
  }
elseif($mode=="reg"&&$_SESSION['balls']==999)
  {
  if(isset($edit))
    {
    $error=0;
    if($per['type_str']!=3) $per['font']="";
    if(empty($per['noise'])) $per['noise']=1000;
    if($per['type_str']>3 && $per['type_str']<1) $error=1;
    if($per['type_str']==3 && !file_exists("./fonts/$per[font].ttf")) $error=1;
    if($error!=1)
      {
      mysql_query("update chat_config set value='$per[type_str]' where name='type_str'");
      mysql_query("update chat_config set value='$per[font]' where name='font'");
      mysql_query("update chat_config set value='$per[noise]' where name='noise'");
      }
    echo "<br><meta http-equiv='refresh' content='0; url=javascript:history.go(-1)'>\n";
    }
  else
    {?>
    <table width="100%" cellspacing="0" cellpadding="0" border="0">
    <tr>
    <td colspan="2" height="25" align="right" nowrap="nowrap">
    <span class=big><i>&raquo Строка регистрации</i></span></td>
    </tr>
    </table>
    <table cellpadding=1 cellspacing=3 width=100% border=0>
    </table>
    <form action=adm.php?mode=reg method=post name=form>
    <table cellpadding=1 cellspacing=3 width=100% border=0>
    <tr><td class=tcat width=60%><span class=smallfont><b>Изображение при регистрации</b></span></td>
    <td class=alt2 width=40%><select id="type_str" name="per[type_str]" class=smallfont onChange="if(form.type_str.value!=3) form.font.disabled=true; else form.font.disabled=false; if(form.type_str.value==1) form.noise.disabled=true; else form.noise.disabled=false;">
    <option value=1<?if($type_str==1) echo" selected";?>>Без изображения
    <option value=2<?if($type_str==2) echo" selected";?>>Средствами GD2
    <option value=3<?if($type_str==3) echo" selected";?>>Средствами GD2 с использованием TTF
    </select>
    </td>
    </tr>
    <tr><td class=tcat width=60%><span class=smallfont><b>Шрифт (директория fonts)</b></span></td>
    <td class=alt2 width=40%><select id="font" name="per[font]" class=smallfont <?if($type_str!=3)echo"disabled";?>>
    <?
    $scanttf=opendir("./fonts");
    while($readttf=readdir($scanttf))
      {
      if(preg_match("#^([a-z0-9_]+)\.ttf$#is",$readttf,$parse))
        {
        echo "<option value=\"$parse[1]\"";
        if($parse[1]==$font) echo" selected";
        echo ">$parse[1]\r\n";
        }
      }
    ?>
    </select>
    </td>
    </tr>
    <tr><td class=tcat width=60%><span class=smallfont><b>Уровень шума на изображении</b></span></td>
    <td class=alt2 width=40%><input type=text name="per[noise]" id="noise" value="<?echo$noise;?>" maxlength="4" class="smallfont" size=25 <?if($type_str==1)echo"disabled";?>></td>
    </tr>
    <tr><td class=tcat width=60%><span class=smallfont><b>Текущее изображение:</b></span></td>
    <td class=alt2 width=40%><img src="../img.php"></td>
    </tr>
    <tr>
    <td colspan=2 class=tcat align=center><input type=submit name=edit value="Редактировать"> <input type=reset value="Сбросить"></td>
    </tr>
    </table></form><?
    }
  }
elseif($mode=="dump"&&$_SESSION['balls']==999)
  {
  if(isset($dumping))
    {
    $dump=$test="";
    $z=$i=$u=0;
    $q1=mysql_query("show tables");
    $z=1;
    while($a1=mysql_fetch_array($q1))
      {
      list($pref,$table)=explode("_",$a1[0]);
      if($pref=="chat")
        {
        $dump.="DROP TABLE IF EXISTS `$a1[0]`;\r\n";
        $dump.="CREATE TABLE `$a1[0]` (\r\n";
        $q2=mysql_query("describe $a1[0]");
        while($a2=mysql_fetch_row($q2))
          {
          $dump.="&nbsp;&nbsp;`$a2[0]` $a2[1] ";
          if($a2[2]=="YES") $dump.="default NULL,\r\n";
          elseif($a2[5]=="auto_increment") $dump.="NOT NULL auto_increment,\r\n";
          elseif($a2[4]!="NULL") $dump.="NOT NULL default '$a2[4]',\r\n";
          if($a2[3]=="PRI")
            {
            $s[$z]="&nbsp;&nbsp;PRIMARY KEY (`$a2[0]`)";
            $z++;
            }
          elseif($a2[3]=="UNI")
            {
            $s[$z]="&nbsp;&nbsp;UNIQUE KEY (`$a2[0]`)";
            $z++;
            }
          $i++;
          }
        $z=1;
        $count=count($s);
        foreach($s as $key=>$val)
          {
          if($key!=$count) $dump.=$s[$key].",\r\n";
          else $dump.=$s[$key]."\r\n";
          }
        $dump.=");\r\n\r\n";
        if($test!=$a1[0]) $i=$i-$u;
        $test=$a1[0];
        $u=$i;
        $q3=mysql_query("select * from $a1[0]");
        while($a3=mysql_fetch_row($q3))
          {
          $dump.="INSERT INTO $a1[0] VALUES ($a3[0]";
          $t=$i-1;
          for($w=1;$w<=$t;$w++) $dump.=",'".htmlspecialchars(trim(mysql_escape_string($a3[$w])))."'";
          $dump.=");\r\n";
          $dump.="";
          }
        $dump.="\r\n\r\n";
        }
      }?>
    <table width="100%" cellspacing="0" cellpadding="0" border="0">
    <tr>
    <td colspan="2" height="25" align="right" nowrap="nowrap">
    <span class=big><i>&raquo Дамп БД</i></span></td>
    </tr>
    </table>
    <table cellpadding=1 cellspacing=3 border=0 width=100% height=700>
    <tr>
    <td valign=top height=20 align=center class=tcat>Дамп БД</td>
    </tr>
    <tr>
    <td valign=top class=alt2>
    <textarea style="width: 1000; height: 100%" wrap="OFF"><?echo$dump;?></textarea>
    </td>
    </tr>
    </table><?
    }
  else
    {?>
    <table width="100%" cellspacing="0" cellpadding="0" border="0">
    <tr>
    <td colspan="2" height="25" align="right" nowrap="nowrap">
    <span class=big><i>&raquo Дамп БД</i></span></td>
    </tr>
    </table>
    <table cellpadding=1 cellspacing=3 border=0 width=100%>
    <tr>
    <td valign=top align=center class=tcat>Дамп БД</td>
    </tr>
    <tr>
    <td valign=top align=center class=alt2>
    <form action=adm.php?mode=dump method=post>
    <input type=submit name=dumping value="Начать резервирование">
    </form></td>
    </tr>
    </table><?
    }
  }
elseif($_SESSION['balls']==999)
  {
  if($act=="edit")
    {
    $error=0;
    foreach($per as $key=>$val)
      {
      if(empty($per[$key])&&$per[$key]!="0") $error=1;
      }
    if(empty($error))
      {
      $query_upd=mysql_query("select * from chat_config where other order by other");
      while($arr_upd=mysql_fetch_array($query_upd))
        {
        if($arr_upd['value']!=stripslashes($per[$arr_upd['name']]))
          {
          $query="update chat_config set value='".$per[$arr_upd['name']]."' where name='$arr_upd[name]'";
          if(mysql_query($query)) {}
          else echo'<b>Ошибка SQL:</b> невозможно записать опцию <br>'.mysql_error().'<br>('.__FILE__.'::строка '.__LINE__.')';
          }
        }
      echo "<br><meta http-equiv='refresh' content='0; url=javascript:history.go(-1)'>\n";
      }
    else
      {
      echo "Произошла ошибка!<br>Не указан один или более параметров";
      }
    }
  else
    {?>
    <table width="100%" cellspacing="0" cellpadding="0" border="0">
    <tr>
    <td colspan="2" height="25" align="right" nowrap="nowrap">
    <span class=big><i>&raquo Опции</i></span></td>
    </tr>
    </table>
    <table cellpadding=1 cellspacing=3 width=100% border=0>
    </table>  
    <form action=adm.php method=post name=form>
    <input type=hidden name=act value=edit>
    <table cellpadding=1 cellspacing=3 width=100% border=0><?
    $query_opts=mysql_query("select * from chat_config where other order by other") or die(mysql_error());
    while($arr=mysql_fetch_array($query_opts))
      {
      $tegs=explode("|||",$arr['other']);
      $zn=($tegs[3])?explode('|',$tegs[3]):array('','','','');
      $vl=($tegs[4])?explode('|',$tegs[4]):array('','','','');
      echo"<tr><td class=tcat width=60%><span class=smallfont><b>$tegs[2]</b></span></td>\r\n
      <td class=alt2 width=40%>";
      if($tegs[1]==1)
        {
        echo "<input type=text name=\"per[$arr[name]]\" id=\"$arr[name]\" value=\"$arr[value]\" maxlength=\"255\" class=\"smallfont\" size=25>\n";
        if($arr['name']=='chat_url')
          {
          if($optval['chat_url']!="http://".getenv("HTTP_HOST"))
            {
            echo"\n<span class=smallfont>
            Ошибочный URL <a href=\"#\" style=\"color: red;\" onclick=\"form.chat_url.value='http://".getenv("HTTP_HOST")."'\"
            onMouseOver=\"window.status='У вас ошибочный URL, кликните сюда для замены';return true\"
            onMouseOut=\"window.status='';return true\">http://".getenv("HTTP_HOST")."</a></span>";
            }
          }
        }
      elseif($tegs[1]==2)
        {
        echo "<textarea name=\"per[$arr[name]]\" style=\"height: 100px;width: 250px;\" class=\"smallfont\">$arr[value]</textarea>\n";
        }
      elseif ($tegs[1] == 3)
        {
        while(list($key,$val) = each($zn))
          {
          echo "<input type=radio name=\"per[$arr[name]]\" value=\"$val\"";
          if ($arr['value']==$val) echo " checked";
          echo "> <span class=smallfont>$vl[$key]</span><br>\n";
          }
        }
      elseif($tegs[1] == 4)
        {
        echo "<select id=\"tipteg\" name=\"per[$arr[name]]\" class=smallfont>";
        while(list($key,$val)=each($zn))
          {
          echo "<OPTION value=\"$val\"";
          if ($arr['value']==$val) echo " selected";
          echo "> $vl[$key]</OPTION>\n";
          }
        echo "</select>";
        }
      echo"</td></tr>\r\n";
      }?>
    <tr>
    <td colspan=2 class=tcat align=center><input type=submit value="Редактировать"> <input type=reset value="Сбросить"></td>
    </tr>
    </table><?
    }
  }
else
  {
  echo "<script language=javascript>window.close();</script>";
  }
?>
<br><br><table cellpadding=5 cellspacing=0 width=100% align=center>
<tr>
<td valign=top colspan=2 bgColor=#a9bfd4 align=right style="color: #ffffff;">
<b>Powered by <a href="mailto:remezov2004@mail.ru">SmZchat v<span style="color:#FA2B2B"><b>i</b></span>oo3</a>&nbsp;&nbsp</b></td>
</tr>
</table>
<?include("design/footer.tpl");?>