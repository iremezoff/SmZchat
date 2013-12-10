<?
define("C_MOD",1);
include("inc/functions.php");

$mode=empty($mode)?"":$mode;
$page=empty($page)?"":$page;
$act=empty($act)?"":$act;

if($mode=="in"&&isset($_SESSION['suser']))
  {
  $title=$lang['person']." &raquo; ".$lang['inbox'];
  include("design/header.tpl");
  $count=mysql_result(mysql_query("select count(*) from chat_mail where userto='$_SESSION[suser]' and viewin='1'"),0,'count(*)');
  $pages=ceil($count/20);
  if($page=="" or $page=="0") $lim="0";
  else $lim=($page-1)*20;
  $query_ins=mysql_query("select * from chat_mail where userto='$_SESSION[suser]' and viewin='1' order by time desc limit $lim,20");?>
  <h3><?echo$lang['inbox'];?></h2>
  <table cellpadding=1 cellspacing=1 width=100% border=0>
  <tr>
  <td class=tcat align=center>#</td>
  <td class=tcat align=center><?echo$lang['fromuser'];?></td>
  <td class=tcat align=center><?echo$lang['theme'];?></td>
  <td class=tcat align=center><?echo$lang['when'];?></td>
  <td class=tcat align=center><?echo$lang['action'];?></td>
  </tr>
  <tr>
  <td class=smallfont colspan=5><?echo$lang['total'];?>: <?echo$count;?>. <?echo$lang['pages'];?>: <?pages($count);?></td>
  </tr><?
  while($array_ins=mysql_fetch_array($query_ins))
    {
    $date=date("d.m.Y H:i:s",$array_ins['time']);
    if($array_ins['rd']!=1) { $b1="<b>";$b2="</b>"; }
    else { $b1="";$b2=""; }
    echo "<tr>";
    echo "<td></td>";
    echo "<td>$b1$array_ins[user]$b2</td>";
    echo "<td><a href=\"mail.php?mode=read&id=$array_ins[id]\">$b1$array_ins[theme]$b2</a></td>";
    echo "<td>$b1$date$b2</td>";
    echo "<td>
    <a href=\"mail.php?mode=read&act=del&id=$array_ins[id]\" onClick=\"return confirm('$lang[confirm]');\">$lang[del]</a></td>";
    echo "</tr>";
    }
  echo "</table>";
  }
elseif($mode=="out"&&isset($_SESSION['suser']))
  {
  $title=$lang['person']." &raquo; ".$lang['outbox'];
  include("design/header.tpl");
  $count=mysql_result(mysql_query("select count(*) from chat_mail where user='$_SESSION[suser]' and viewout='1'"),0,'count(*)');
  $pages=ceil($count/20);
  if($page=="" or $page=="0") $lim="0";
  else $lim=($page-1)*20;
  $query_outs=mysql_query("select * from chat_mail where user='$_SESSION[suser]' and viewout='1' order by time desc limit $lim,20");?>
  <h3><?echo$lang['outbox'];?></h2>
  <table cellpadding=1 cellspacing=1 width=100% border=0>
  <tr>
  <td class=tcat align=center>#</td>
  <td class=tcat align=center><?echo$lang['touser'];?></td>
  <td class=tcat align=center><?echo$lang['theme'];?></td>
  <td class=tcat align=center><?echo$lang['when'];?></td>
  <td class=tcat align=center><?echo$lang['action'];?></td>
  </tr>
  <tr>
  <td class=smallfont colspan=5><?echo$lang['total'];?>: <?echo$count;?>. <?echo$lang['pages'];?>: <?pages($count);?></td>
  </tr><?
  while($array_outs=mysql_fetch_array($query_outs))
    {
    $date=date("d.m.Y H:i:s",$array_outs['time']);
    echo "<tr>";
    echo "<td></td>";
    echo "<td>$array_outs[userto]</td>";
    echo "<td><a href=\"mail.php?mode=read&id=$array_outs[id]\">$array_outs[theme]</a></td>";
    echo "<td>$date</td>";
    echo "<td>
    <a href=\"mail.php?mode=read&act=del&id=$array_outs[id]\" onClick=\"return confirm('$lang[confirm]');\">$lang[del]</a></td>";
    echo "</tr>";
    }
  echo "</table>";
  }
elseif($mode=="write"&&isset($_SESSION['suser']))
  {
  $title=$lang['person']." &raquo; ".$lang['newletter'];
  include("design/header.tpl");
  if($act=="send")
    {
    $error="";
    if(empty($userto_new)) $error.=$lang['error']['nick']."<br>";
    elseif(strtolower($userto_new)==strtolower($_SESSION['suser'])) $error.=$lang['error']['self']."<br>";
    if(empty($theme_new)) $error.=$lang['error']['theme']."<br>";
    if(empty($text_new)) $error.=$lang['error']['text']."<br>";
    if(empty($error))
      {
      $check=mysql_num_rows(mysql_query("select id from chat_users where user='$userto_new'"));
      if($check<1) $error.=$lang['error']['tox']."<br>";
      $check2=mysql_num_rows(mysql_query("select id from chat_mail where (user='$_SESSION[suser]' and viewout='1') or (userto='$_SESSION[suser]' and viewin='1')"));
      if($check2>=$max_msgs) $error.=$lang['error']['yourlimit']."<br>";
      $check3=mysql_num_rows(mysql_query("select id from chat_mail where (user='$userto_new' and viewout='1') or (userto='$userto_new' and viewout='1')"));
      if($check3>=$max_msgs) $error.=$lang['error']['tolimit']."<br>";
      }
    if(empty($error))
      {
      $time=time();
      if(empty($smileson_new)) $smileson_new=0;
      $text_new=encode($text_new,$smileson_new);
      $query_send="insert into chat_mail values ('','$_SESSION[suser]','$userto_new','$time','$theme_new','$text_new','0','1','1')";
      if(mysql_query($query_send))
        {
        echo $lang['complete']['send'];
        echo "<br><a href=\"mail.php?mode=out\">$lang[back]</a>";
        }
      else
        {
        echo $lang['complete']['sendx'];
        echo "<br><a href=\"javascript:history.go(-1)\">$lang[back]</a>";
        }
      }
    else
      {
      echo $lang['complete']['error']."<br>".$lang['complete']['copy'].":<textarea style=\"width:100%\" rows=25 class=smallfont>$text</textarea>";
      echo "<br><a href=\"javascript:history.go(-1)\">$lang[back]</a>";
      }
    }
  else
    {?>
    <script language=JavaScript><!--
    var ico;
    function smile(ico) {document.form.text_new.value=document.form.text_new.value+ico;}
    function check(){
    var error  = 1 ;
    if (form.userto_new.value == "") { Mess('<?echo$lang['error']['nick'];?>','userto_new'); return 0;}
    else if (form.userto_new.value == "<?echo$_SESSION['suser'];?>") { Mess('<?echo$lang['error']['self'];?>','userto_new'); return 0;}
    if (form.theme_new.value == "") { Mess('<?echo$lang['error']['theme'];?>','theme_new'); return 0;}
    if (form.text_new.value == "") { Mess('<?echo$lang['error']['text'];?>','text_new'); return 0;}
    return error;
    }
    function Mess (mms,str){
    form.elements[str].focus () ;
    alert (mms) ;
    }
    //-->
    </script>
    <h3><?echo$lang['newletter'];?></h3>
    <form action=mail.php?mode=write method=post name=form>
    <input type=hidden name=act value=send>
    <table cellpadding=1 cellspacing=1 width=100% border=0>
    <tr>
    <td class=alt2 width=20%><b><?echo$lang['touser'];?>:</b></td>
    <td class=alt2 width=80%><input type=text name=userto_new size=25></td>
    </tr>
    <tr>
    <td class=alt2 width=20%><b><?echo$lang['theme'];?>:</b></td>
    <td class=alt2 width=80%><input type=text name=theme_new size=25></td>
    </tr>
    <tr>
    <td colspan=2><b><?echo$lang['text'];?>:</b><br>
    <textarea name=text_new style="width:100%" rows=25 class=smallfont></textarea></td>
    </tr>
    <tr>
    <td class=alt2 width=20%><b><?echo$lang['onsmiles'];?>:</b></td>
    <td class=alt2 width=80%><input type=checkbox name=smileson_new checked value=1></td>
    </tr>
    <tr>
    <td colspan=2 class=alt2>
    <input type=button value="<?echo$lang['sendletter'];?>" onClick="if (check()) submit();"></td>
    </tr>
    </table></form>
    <b><?echo$lang['smiles'];?>:</b>
    <table cellpadding=0 cellspacing=0 border=0 width=700>
    <tr>
    <td valign=top width=500>
    <table cellpadding=1 cellspacing=1 width=500 border=0><?
    $i=1;
    $query_smiles=mysql_query("select * from chat_smiles group by url desc");
    while($array_smiles=mysql_fetch_array($query_smiles))
      {
      if($i==1) echo "<tr>";?>
      <td align=center>
      <a href="javascript: smile(' <?echo$array_smiles['code'];?> ');">
      <img src="smiles/<?echo$array_smiles['url'];?>" border=0></a></td><?
      if($i==10) {$i=1; echo "</tr>";}     
      else $i++;
      }?>
    </table></td>
    <td valign=top width=100>
    <table cellpadding=1 cellspacing=1 width=100 border=0>
    <tr>
    <td valign=top width=85><a href="javascript: smile(' [b]   [/b] ');" class=as>[b] [/b]</td>
    <td valign=top><big><b><?echo$lang['b'];?></b></big></a></td>
    </tr>
    <tr>
    <td valign=top width=85><a href="javascript: smile(' [i]   [/i] ');" class=as>[i] [/i]</a></td>
    <td valign=top><big><i><?echo$lang['i'];?></i></big></td>
    </tr>
    <tr>
    <td valign=top width=85><a href="javascript: smile(' [u]   [/u] ');" class=as>[u] [/u]</a></td>
    <td valign=top><big><u><?echo$lang['u'];?></u></big></td>
    </tr>
    <tr>
    <td valign=top width=85><a href="javascript: smile(' [sup]   [/sup] ');" class=as>[sup] [/sup]</a></td>
    <td valign=top><big><sup><?echo$lang['sup'];?></sup></big></td>
    </tr>
    <tr>
    <td valign=top width=85><a href="javascript: smile(' [sub]   [/sub] ');" class=as>[sub] [/sub]</a></td>
    <td valign=top><big><sub><?echo$lang['sub'];?></sub></big></td>
    </tr>
    </table></td>
    </tr>
    </table><?
    }
  }
elseif($mode=="read"&&isset($_SESSION['suser']))
  {
  $query_check=mysql_query("select userto from chat_mail where id='$id' and ((user='$_SESSION[suser]' and viewout='1') or (userto='$_SESSION[suser]' and viewin='1'))") or die(mysql_error());
  $check=mysql_num_rows($query_check);
  if($check>0)
    {
    $title=$lang['person'];
    $getuserto=mysql_result($query_check,0,'userto');
    if($act=="del")
      {
      include("design/header.tpl");
      if($_SESSION['suser']==$getuserto) { $add="viewin";$go="in"; }
      else { $add="viewout";$go="out";}
      $title=$lang['person'];
      $query_del="update chat_mail set $add=0 where id='$id'";
      if(mysql_query($query_del))
        {
        mysql_query("delete from chat_mail where viewin='0' and viewout='0'");
        echo $lang['complete']['del'];
        echo "<br><a href=\"mail.php?mode=$go\">$lang[back]</a>";
        }
      else
        {
        echo $lang['complete']['delx'];
        echo "<br><a href=\"mail.php?mode=$go\">$lang[back]</a>";
        }
      }
    else
      {
      if(strtolower($_SESSION['suser'])==strtolower($getuserto))
        mysql_query("update chat_mail set rd='1' where id='$id'") or die(mysql_error());
      $query_mess=mysql_query("select user,userto,time,theme,text from chat_mail where id='$id'") or die(mysql_error());
      list($user_in,$userto_in,$time_in,$theme_in,$text_in)=mysql_fetch_row($query_mess);
      if(strtolower($_SESSION['suser'])==strtolower($getuserto)) { $go="in"; $toin=$lang['fromuser']; $user_view=$user_in; }
      else { $go="out"; $toin=$lang['touser']; $user_view=$userto_in; }
      $date_in=date("d.m.Y H:i:s",$time_in);
      $title.=" &raquo; $theme_in";
      include("design/header.tpl");?>
      <h3><?echo$theme_in;?></h3>
      <table cellpadding=1 cellspacing=1 width=100% border=0>
      <tr>
      <td class=alt2 width=20%><b><?echo$toin;?>:</b></td>
      <td class=alt2 width=80%><?echo$user_view;?></td>
      </tr>
      <tr>
      <td class=alt2><b><?echo$lang['when'];?>:</b></td>
      <td class=alt2><?echo$date_in;?></td>
      </tr>
      <tr>
      <td colspan=2><b><?echo$lang['text'];?>:</b><br><br>
      <?echo$text_in;?></td>
      </tr>
      <tr>
      <td colspan=2 class=alt2>
      <a href="mail.php?mode=read&act=del&id=<?echo$id;?>" onClick="return confirm('<?echo$lang['confirm'];?>');"><?echo$lang['del'];?></a></td>
      </tr>
      </table><?
      echo "<br><a href=\"mail.php?mode=$go\">$lang[back]</a>";
      }
    }
  }
else
  {?>
  <script language=javascript>window.close();</script><?
  }
include("design/footer.tpl");
?>