<?
define("C_MOD",1);
include("inc/functions.php");

$title="������ �����������������";
include("design/header.tpl");

if($_SESSION['balls']>=700)
  {
  echo "
  <table cellpadding=0 cellspacing=0 width=100% border=0>
  <tr>
  <td align=center>[ <a href=\"adm.php?mode=rules\">�������������� ������</a> ]</td>
  <td align=center>[ <a href=\"adm.php?mode=smiles\">�������������� �������</a> ]</td>";
  if($_SESSION['balls']==999)
  echo "
  <td align=center>[ <a href=\"adm.php?mode=balls\">�������������� ������</a> ]</td>
  <td align=center>[ <a href=\"adm.php?mode=rooms\">�������������� ������</a> ]</td>
  <td align=center>[ <a href=\"adm.php?mode=compl\">�������� ������</a> ]</td>
  <td align=center>[ <a href=\"adm.php?mode=langs\">�����</a> ]</td>
  <td align=center>[ <a href=\"adm.php?mode=reg\">������ �����������</a> ]</td>
  <td align=center>[ <a href=\"adm.php?mode=dump\">���� ��</a> ]</td>
  <td align=center>[ <a href=\"adm.php\">�����</a> ]</td>";
  echo "</tr>
  </table>
  <hr width=100% size=2 color=#000000>
  <a href=\"javascript:history.go(-1)\"><b>&laquo; �����</b></a><br>";
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
      echo "������� ������� ���������������";
      }
    else
      {
      echo "�� ����������� �� ������ �������";
      }
    }
  elseif(isset($addrule))
    {
    $count=0;
    foreach($newrule as $key=>$val)
      {
      if($val) {$count++;$val2=$val;$key2=$key;}
      }
    if($count<1) $error.="�� �� ����� ���������� ������ �������";
    if(empty($error))
      {
      $query_newrule="insert into chat_rules values ('','$key2','$val2')";
      if(mysql_query($query_newrule))
        {
        echo "������� ������� ��������� � ����!";
        }
      }
    else
      {
      echo "��������� ������!<br>$error";
      }
    }
  elseif(isset($addcat))
    {
    if(!$newcat) $error.="�� �� ����� �������� ����� ���������";
    if(empty($error))
      {
      $query_newcat="insert into chat_rules_cats values ('','$newcat')";
      if(mysql_query($query_newcat))
        {
        echo "����� ��������� ������� ��������� � ����!";
        }
      }
    else
      {
      echo "��������� ������!<br>$error";
      }
    }
  else
    {
    $query_cats=mysql_query("select * from chat_rules_cats order by id");?>
    <table width="100%" cellspacing="0" cellpadding="0" border="0">
    <tr>
    <td colspan="2" height="25" align="right" nowrap="nowrap">
    <span class=big><i>&raquo �������������� ������</i></span></td>
    </tr>
    </table>
    <span class=smallfont>* <b>�������� ���� ������, ���� ������ ������� ������� ��� ��������� ������</b></span>
    <form action=adm.php?mode=rules method=post>
    <table cellpadding=1 cellspacing=3 width=100% border=0>
    <tr>
    <td valign=top class=tcat align=center>�������������� ������</td>
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
      echo "<br>������ �������: <input type=text name=newrule[$array_cats[id]] class=smallfont soze=100></textarea>
      <input type=submit name=addrule value=\"��������!\" class=smallfont>
      </td>
      </tr>
      <tr><td class=tcat><hr width=80%></td></tr>";
      }?>
    <tr><td>&nbsp;</td></tr>
    <tr>
    <td valign=top class=tcat align=center><br>
    <input type=submit name=editrs value="�������� �������"><br><br></td>
    </tr>
    <tr><td>&nbsp;</td></tr>
    <tr>
    <td valign=top class=tcat>
    ����� ���������: <input type=text name=newcat size=25> <input type=submit name=addcat value="��������">
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
    if(!$smile_code) $error.="�� ������ ��� ��������!";
    if(empty($error))
      {
      $query_add="INSERT INTO chat_smiles VALUES ('','$smile_code','$smile_url')";
      if(mysql_query($query_add))
        {
        echo "������� ������� �������� � ����!";
        }
      else 
        {
        echo "��������� ������ ��� ���������� �������� � ����! ��������, ����� ��� ��� ����������.";
        }
      }
    else 
      {
      echo "��������� ������!<br>$error";
      }
    }
  elseif(isset($edit))
    {
    $error="";
    if(empty($smile_code)) $error.="�� ������ ��� ��������!";
    if(empty($error))
      {
      $query_upd="update chat_smiles set code='$smile_code', url='$smile_url' where id='$id'";
      if(mysql_query($query_upd))
        {
        echo "������� ������� ��������������!";
        }
      else 
        {
        echo "��������� ������ ��� �������������� �������� � ����!";
        }
      }
    else 
      {
      echo "��������� ������!<br>$error";
      }
    }
  elseif($operat=="del")
    {      
    $query_del="delete from chat_smiles where id='$id'";
    if(mysql_query($query_del))
      {
      echo "������� ������� �����!";
      }
    else 
      {
      echo "��������� ������ ��� �������� �������� �� ����!";
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
      <span class=big><i>&raquo ���������� ����������</i></span></td>
      </tr>
      </table>
      <form action=adm.php?mode=smiles method=post>
      <table cellpadding=1 cellspacing=3 width=100% border=0 align=center>
      <tr>
      <td valign=top align=center class=tcat colspan=2>���������� ��������</td>
      </tr>
      <tr>
      <td valign=top class=alt2 width=50%>��� ��������</td>
      <td valign=top class=alt2 width=50%>
      <input type=text name=smile_code size=25></td>
      </tr>
      <tr>
      <td class=alt2 width=50%>���� � ������������ ��������</td>
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
      <input type=submit name=add value="��������"></td>
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
      <span class=big><i>&raquo ���������� ����������</i></span></td>
      </tr>
      </table>
      <form action=adm.php?mode=smiles method=post>
      <input type=hidden name=id value="<?echo$id_sm;?>">
      <table cellpadding=1 cellspacing=3 width=100% border=0 align=center>
      <tr>
      <td valign=top align=center class=tcat colspan=2>�������������� ��������</td>
      </tr>
      <tr>
      <td valign=top class=alt2 width=50%>��� ��������</td>
      <td valign=top class=alt2 width=50%>
      <input type=text name=smile_code value="<?echo$smile_code;?>" size=25></td>
      </tr>
      <tr>
      <td class=alt2 width=50%>���� � ������������ ��������</td>
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
      <input type=submit name=edit value="��������"></td>
      </tr>
      </table></form><?         
      }
    else
      {
      $query_smiles=mysql_query("select * from chat_smiles order by id;");?>
      <table width="100%" cellspacing="0" cellpadding="0" border="0">
      <tr>
      <td colspan="2" height="25" align="right" nowrap="nowrap">
      <span class=big><i>&raquo ���������� ����������</i></span></td>
      </tr>
      </table>
      <table cellpadding=1 cellspacing=3 width=100% border=0 align=center>
      <tr>
      <td align=center colspan=4>
      <a href="adm.php?mode=smiles&act=add">���������� ��������</a></td>
      </tr>
      <tr>
      <td valign=top align=center class=tcat colspan=4>���������� ����������</td>
      </tr>
      <tr>
      <td align=center class=tcat width=20%><b>��� ��������</b></td>
      <td align=center class=tcat width=20%><b>����������� ��������</b></td>
      <td align=center class=tcat width=30%><b>���� � ������������ ��������</b></td>
      <td align=center class=tcat width=30%><b>��������</b></td>
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
        <td align=center class=alt2 width=30% ><a href="adm.php?mode=smiles&act=edit&id=<?echo$id_smile;?>">��������</a>
        <a href="adm.php?mode=smiles&operat=del&&id=<?echo$id_smile;?>"
        onClick="return confirm('�� ������������� ������ ������� ���� �������?');">�������</a></td>
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
    if(empty($setuser)) $error.="�� ������ ������������.<br>";
    if(empty($setballs)&&$setballs!="0") $error.="�� ������� �����.<br>";
    if(empty($error))
      {
      $query_edit="update chat_users set balls='$setballs' where user='$setuser'";
      if(mysql_query($query_edit))
        {
        echo "����� ������� ���������������.";
        }
      else
        {
        echo "��������� ������ ��� �������������� ������.";
        }
      }
    else 
      {
      echo "��������� ������!<br>$error";
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
      echo "����� ������� �������!";
      }
    else 
      {
      echo "��������� ������ ��� �������� ������ �� ����!";
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
    <span class=big><i>&raquo ���������� �������</i></span></td>
    </tr>
    </table>
    <table cellpadding=1 cellspacing=3 width=100% border=0 align=center>
    <tr>
    <td valign=top align=center class=tcat colspan=4>���������� �������</td>
    </tr>
    <tr>
    <td align=center class=tcat width=30%><b>������������</b></td>
    <td align=center class=tcat width=30%><b>�����</b></td>
    <td align=center class=tcat width=40%><b>��������</b></td>
    </tr>
    <tr>
    <td class=alt2 colspan=3><span class=smallfont>�����: <b><?echo$pages;?></b>. ��������: <b><?pages($count);?></b></span></td>
    </tr><?
    while($array_balls=mysql_fetch_array($query_balls))
      {
      echo "<tr>
      <td align=center class=alt2 width=20%><b>$array_balls[user]</b></td>
      <td align=center class=alt2 width=20%>$array_balls[balls]</td>
      <td align=center class=alt2 width=30%>
      <a href=\"adm.php?mode=balls&operat=del&&id=$array_balls[id]\"
      onClick=\"return confirm('�� ������������� ������ ������� ����� ����� ������������?');\">������� �����</a></td>
      </tr>";
      }
    echo "<tr>
    <td colspan=3 class=tcat><form action=adm.php?mode=balls method=post>
    �������� �����:
    ������������: <input type=text name=setuser> �����: <input type=text name=setballs maxlength=3>
    <input type=submit name=edit value=\"��������\"></form></td></tr>";
    echo "</table>";
    }
  }
elseif($mode=="rooms"&&$_SESSION['balls']==999)
  {
  if(isset($add))
    {
    $error="";
    if(empty($newroom)) $error.="�� ������� �������� �������!<br>";
    if(empty($newbot)) $error.="�� ������� ��� ����!<br>";
    if(empty($error))
      {
      $query_add="insert into chat_rooms values('','$newroom','$newbot')";
      if(mysql_query($query_add))
        {
        echo "������� ������� ���������!";
        }
      else
        {
        echo "��������� ������ ��� ���������� �������!";
        }
      }
    else
      {
      echo "��������� ������!<br>$error";
      }
    }
  elseif(isset($edit))
    {
    $error="";
    if(empty($setroom)) $error.="�� ������� �������� �������!<br>";
    if(empty($setbot)) $error.="�� ������� ��� ����!<br>";
    if(empty($error))
      {
      $query_edit="update chat_rooms set name='$setroom',botname='$setbot' where id='$id_room'";
      if(mysql_query($query_edit))
        {
        echo "������� ������� ���������������!";
        }
      else
        {
        echo "��������� ������ ��� �������������� �������!";
        }
      }
    else
      {
      echo "��������� ������!<br>$error";
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
      echo "������� ������� �������";
      }
    else
      {
      echo "��������� ������ ��� �������� �������";
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
      <span class=big><i>&raquo �������������� ������</i></span></td>
      </tr>
      </table>
      <form action=adm.php?mode=rooms method=post>
      <input type=hidden name=id_room value=<?echo$id_room;?>>
      <table cellpadding=1 cellspacing=3 width=100% border=0>
      <tr>
      <td align=center class=tcat colspan=2>�������������� �������</td>
      </tr>
      <tr>
      <td class=alt2 width=20%><b>�������� �������:</b></td>
      <td class=alt2 width=80%><input type=text name=setroom value="<?echo$name_room;?>"></td>
      </tr>
      <tr>
      <td class=alt2 width=20%><b>��� ����:</b></td>
      <td class=alt2 width=80%><input type=text name=setbot value="<?echo$name_bot;?>"></td>
      </tr>
      <tr>
      <td align=center class=tcat colspan=2><input type=submit name=edit value="�������������"></td>
      </tr>
      </table></form><?
      }
    else
      {
      $query_rooms=mysql_query("select * from chat_rooms order by id");?>
      <table width="100%" cellspacing="0" cellpadding="0" border="0">
      <tr>
      <td colspan="2" height="25" align="right" nowrap="nowrap">
      <span class=big><i>&raquo �������������� ������</i></span></td>
      </tr>
      </table>
      <table cellpadding=1 cellspacing=3 width=100% border=0>
      <tr>
      <td valign=top class=tcat align=center>#</td>
      <td valign=top class=tcat align=center>�������</td>
      <td valign=top class=tcat align=center>����</td>
      <td valign=top class=tcat align=center>��������</td>
      </tr><?
      $r=1;
      while($array_rooms=mysql_fetch_array($query_rooms))
        {?>
        <tr>
        <td align=center class=alt2><?echo$r;?></td>
        <td align=center class=alt2><b><?echo$array_rooms['name'];?></b></td>
        <td align=center class=alt2><b><?echo$array_rooms['botname'];?></b></td>
        <td align=center class=alt2><a href="adm.php?mode=rooms&act=edit&id=<?echo$array_rooms['id'];?>">�������������</a> |
        <a href="adm.php?mode=rooms&operat=del&id=<?echo$array_rooms['id'];?>"
        onClick="return confirm('�� ������������� ������ ������� ��� �������?');">�������</a></td>
        </tr><?
        $r++;
        }?>
      <tr>
      <td valign=top colspan=4 class=tcat>
      <form action=adm.php?mode=rooms method=post>
      �������� ����� �������: ��������: <input type=text name=newroom> ���: <input type=text name=newbot> <input type=submit name=add value="��������!">
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
  <span class=big><i>&raquo ������ �� �������</i></span></td>
  </tr>
  </table>
  <table cellpadding=1 cellspacing=3 width=100% border=0 align=center>
  <tr>
  <td valign=top align=center class=tcat colspan=4>������ �� �������</td>
  </tr>
  <tr>
  <td align=center class=tcat width=20%><b>������������</b></td>
  <td align=center class=tcat width=20%><b>���������</b></td>
  <td align=center class=tcat width=20%><b>����</b></td>
  <td align=center class=tcat width=40%><b>�����</b></td>
  </tr>
  <tr>
  <td class=alt2 colspan=4><span class=smallfont>�����: <b><?echo$count;?></b>. ��������: <b><?pages($count);?></b></span></td>
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
    echo "���� ������� ��������<br>����� ���������: $sqls";
    }
  elseif($act=="del"&&$id)
    {
    $query_del="delete from chat_language where lang='$id'";
    if(mysql_query($query_del))
      {
      mysql_query("update chat_users set lang='russian' where lang='$id'");
      mysql_query("delete from chat_onliners where lang='$id'");      
      echo "���� ������� �����";
      }
    else
      {
      echo "��������� ������ ��� �������� �����";
      }
    }
  else
    {
    if($act=="add")
      {?>
      <table width="100%" cellspacing="0" cellpadding="0" border="0">
      <tr>
      <td colspan="2" height="25" align="right" nowrap="nowrap">
      <span class=big><i>&raquo ����������/���������� ������</i></span></td>
      </tr>
      </table>
      <form action=adm.php?mode=langs method=post name=form>
      <table cellpadding=1 cellspacing=3 width=100% border=0>
      <tr>
      <td class=tcat width=60%><span class=smallfont><b>��������������� ����</b></span></td>
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
      <td class=tcat width=60%><span class=smallfont><b>��� ���������</b></span></td>
      <td class=alt2 width=40%><span class=smallfont>
      <input type=radio name=type value=1 checked> ���������� (���������� ����� ���������)<br>
      <input type=radio name=type value=2> ������������� (������ ������ ������ ��������� � ���������� �����)</span></td>
      </tr>
      <tr>
      <td class=tcat colspan=2 align=center><input type=submit name=add value="��������"></td>
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
      <span class=big><i>&raquo �����</i></span></td>
      </tr>
      </table>
      <table cellpadding=1 cellspacing=3 width=100% border=0>
      <tr>
      <td colspan=2 align=center><a href="adm.php?mode=langs&act=add">����������/���������� ������</a></td>
      </tr>
      <tr>
      <td class=tcat width=60% align=center>����</td>
      <td class=tcat width=40% align=center>��������</td>
      </tr><?
      while($arr_langs=mysql_fetch_array($query_langs))
        {
        echo "<tr>";
        echo "<td class=alt2 align=center><b>$arr_langs[lang]</b></td>";
        echo "<td class=alt2 align=center>";
        if($arr_langs['lang']!="russian") echo "<a href=\"adm.php?mode=langs&act=del&id=$arr_langs[lang]\" 
        onClick=\"return confirm('�� ������������� ������ ������� ���� ����? ������ �����������, �������� ����� ����� �������� � ������� � ������ ���� � �������������, ������������ ������ ���� � ��������� �����');\">�������</a>";
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
    <span class=big><i>&raquo ������ �����������</i></span></td>
    </tr>
    </table>
    <table cellpadding=1 cellspacing=3 width=100% border=0>
    </table>
    <form action=adm.php?mode=reg method=post name=form>
    <table cellpadding=1 cellspacing=3 width=100% border=0>
    <tr><td class=tcat width=60%><span class=smallfont><b>����������� ��� �����������</b></span></td>
    <td class=alt2 width=40%><select id="type_str" name="per[type_str]" class=smallfont onChange="if(form.type_str.value!=3) form.font.disabled=true; else form.font.disabled=false; if(form.type_str.value==1) form.noise.disabled=true; else form.noise.disabled=false;">
    <option value=1<?if($type_str==1) echo" selected";?>>��� �����������
    <option value=2<?if($type_str==2) echo" selected";?>>���������� GD2
    <option value=3<?if($type_str==3) echo" selected";?>>���������� GD2 � �������������� TTF
    </select>
    </td>
    </tr>
    <tr><td class=tcat width=60%><span class=smallfont><b>����� (���������� fonts)</b></span></td>
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
    <tr><td class=tcat width=60%><span class=smallfont><b>������� ���� �� �����������</b></span></td>
    <td class=alt2 width=40%><input type=text name="per[noise]" id="noise" value="<?echo$noise;?>" maxlength="4" class="smallfont" size=25 <?if($type_str==1)echo"disabled";?>></td>
    </tr>
    <tr><td class=tcat width=60%><span class=smallfont><b>������� �����������:</b></span></td>
    <td class=alt2 width=40%><img src="../img.php"></td>
    </tr>
    <tr>
    <td colspan=2 class=tcat align=center><input type=submit name=edit value="�������������"> <input type=reset value="��������"></td>
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
    <span class=big><i>&raquo ���� ��</i></span></td>
    </tr>
    </table>
    <table cellpadding=1 cellspacing=3 border=0 width=100% height=700>
    <tr>
    <td valign=top height=20 align=center class=tcat>���� ��</td>
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
    <span class=big><i>&raquo ���� ��</i></span></td>
    </tr>
    </table>
    <table cellpadding=1 cellspacing=3 border=0 width=100%>
    <tr>
    <td valign=top align=center class=tcat>���� ��</td>
    </tr>
    <tr>
    <td valign=top align=center class=alt2>
    <form action=adm.php?mode=dump method=post>
    <input type=submit name=dumping value="������ ��������������">
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
          else echo'<b>������ SQL:</b> ���������� �������� ����� <br>'.mysql_error().'<br>('.__FILE__.'::������ '.__LINE__.')';
          }
        }
      echo "<br><meta http-equiv='refresh' content='0; url=javascript:history.go(-1)'>\n";
      }
    else
      {
      echo "��������� ������!<br>�� ������ ���� ��� ����� ����������";
      }
    }
  else
    {?>
    <table width="100%" cellspacing="0" cellpadding="0" border="0">
    <tr>
    <td colspan="2" height="25" align="right" nowrap="nowrap">
    <span class=big><i>&raquo �����</i></span></td>
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
            ��������� URL <a href=\"#\" style=\"color: red;\" onclick=\"form.chat_url.value='http://".getenv("HTTP_HOST")."'\"
            onMouseOver=\"window.status='� ��� ��������� URL, �������� ���� ��� ������';return true\"
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
    <td colspan=2 class=tcat align=center><input type=submit value="�������������"> <input type=reset value="��������"></td>
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