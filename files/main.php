<?
if(!defined("F_MOD"))
  {
  echo "<meta http-equiv='refresh' content='0; url=/index.php'>";
  exit;
  }
?>
<html>
<head>
<title><?echo $chat_title;?></title>
<META HTTP-EQUIV="Content-Type" Content="text/html;Charset=Windows-1251">
<!-- JavaScript's author: FOX_MALDER aka VSV -->
<script language="JavaScript" id="JS_all">
<!--
var xmlDoc = null;
var  txITOG = "";
var _Browser = "unknown";
var mutetime_rem = 0;
var get_mute_timer = null;
var mins = 0;
var secs = 00;
_userAgent = navigator.userAgent.toLowerCase(); 
     if (_userAgent.indexOf("opera") > -1)      _Browser = "Opera"; 
else if (_userAgent.indexOf("msie") > -1)       _Browser = "Internet Explorer"; 
else if (_userAgent.indexOf("netscape/7") > -1) _Browser = "Netscape Navigator 7"; 
else if (_userAgent.indexOf("netscape/8") > -1) _Browser = "Netscape Navigator 8"; 
else if (_userAgent.indexOf("firefox") > -1)    _Browser = "Firefox"; 
function readFile(file)
{
 //if (typeof window.ActiveXObject != 'undefined') { xmlDoc = new ActiveXObject("Microsoft.XMLHTTP"); } else { xmlDoc = new XMLHttpRequest(); }
 if (window.XMLHttpRequest) { xmlDoc = new XMLHttpRequest(); }
 else if (window.ActiveXObject)
   {
   try { xmlDoc = new ActiveXObject("Msxml2.XMLHTTP"); } catch (e) { try { xmlDoc = new ActiveXObject("Microsoft.XMLHTTP"); } catch (e) {} }
   }

 xmlDoc.open( "GET", file, true );

 if (_Browser == "Firefox") { xmlDoc.overrideMimeType('text/xml;charset=windows-1251'); }

 xmlDoc.setRequestHeader("Version", "HTTP/1.1");
 xmlDoc.setRequestHeader("Content-type", "text/plain; charset=windows-1251");
 xmlDoc.setRequestHeader("Accept-Language", "ru, en");
 xmlDoc.setRequestHeader("Accept-Charset", "windows-1251;q=1");
 xmlDoc.setRequestHeader("Pragma", "no-cache");
 xmlDoc.setRequestHeader("Cache-Control", "no-cache");


 if (typeof window.ActiveXObject!='undefined') { xmlDoc.onreadystatechange = process; } else { xmlDoc.onload = process; }
 xmlDoc.send( null );
}
function process()
{
 if ( xmlDoc.readyState == 4 )
 {
  txITOG = xmlDoc.responseText;
  if (txITOG == "" && window.parent.frames["messages"].document.getElementById("updacc")!=null) { window.parent.frames["messages"].document.getElementById("updacc").value = ""; }
 }
}

function WriteText()
  {
  if (txITOG == "" && window.parent.frames["messages"].document.getElementById("updacc").value!="")
    {
    setTimeout ("WriteText();", 100);
    return false;
    }
  window.parent.frames["messages"].document.getElementById("updacc").value = "";

  var lines = new Array ('');
  lines = txITOG.split(':::');
  for(i=0; i<lines.length-1; i++)
    {
    if (lines[i] == 'clear_m') { window.parent.frames["messages"].document.getElementById("msgs").innerHTML = ""; }
    else if (lines[i] == 'clear_u') { window.parent.frames["users"].document.getElementById("usr").innerHTML = ""; }
    else if (lines[i] == 'logout') { logout(); }
    else
      {
      pole = lines[i].split('|');
      if (pole[0] == 'mess') { inner (pole[1],pole[2],pole[3],pole[4],pole[5],pole[6],pole[7]); }
      else if (pole[0] == 'usrs') { iusers(pole[1],pole[2],pole[3],pole[4],pole[5],pole[6],pole[7]); }
      else if (pole[0] == 'ban') { ban(pole[1],pole[2],pole[3],pole[4]); }
      }
    }
  txITOG = "";
  }

function users_() { window.parent.frames['users'].document.getElementById("usr").innerHTML = ' '; }
function logout() { parent.location.href='./auth.php?mode=exit'; }
function mess_focus()
  {
<?if($_SESSION['focus']==1){?>
  if (window.parent.frames["send"].document.getElementById("muteremtime2").innerHTML == '')
    {
    window.parent.frames["send"].document.getElementById("message").focus();
    }
<?}?>
  }

win_r_v = 0;
function users_menu_hide (win_id)
{
 setTimeout("if (win_r_v == 0) { document.getElementById('"+win_id+"').style.display = 'none';}",2000);
}

var oldest_menu = '';
function users_menu_show (login, bals, ignor, ban, ip, sid, soft)
{
 var name = login;
 if (window.parent.frames['users'].document.getElementById('menu_table_'+login) == null)
 {
  if (bals == '') { bals = 0; }
  if (ignor == '') { ignor = '0'; }
  if (ban == '') { ban = '0'; }
  var image = 'user.gif';
       if (bals == 999 && ban == '0') { image = 'admin.gif'; }
  else if (bals >= 700 && ban == '0') { image = 'moder2.gif'; }
  else if (bals >= 500 && ban == '0') { image = 'moder.gif'; }
  else if (ban != '0') { image = 'bans.gif'; }

  win_r_v=0;
  users_menu_hide('menu_table_'+login);  
  var document_write = '';
  document_write += '<table onmouseout="win_r_v=0;users_menu_hide(\'menu_table_'+login+'\');" onmouseover="win_r_v=1;" cellspacing="1" cellpadding="2" id="menu_table_'+login+'" name="menu_table_'+login+'" class="menu_table">';
  document_write += '<tr><td onclick="to(\''+name+'\'); document.getElementById(\'menu_table_'+login+'\').style.display=\'none\';" width="150" class="menu_def"><center><b>'+login+'</b> ('+bals+')</center></td></tr>';
  document_write += '<tr><td onclick="userinfo(\''+name+'\'); document.getElementById(\'menu_table_'+login+'\').style.display=\'none\';" onmouseover="this.className=\'menu_hover\';" onmouseout="this.className=\'menu_def\';" onselectstart="return false;" class="menu_def"><img src="./theme/<?echo$skin;?>/icons/'+image+'" width="16" height="16" border="0" hspace="5" align="middle"> <?echo$lang['info'];?></td></tr>';

  if (ignor == '0')
  { document_write += '<tr><td onclick="window.parent.frames[\'hidden\'].location.href=\'hidden.php?ignore='+name+'\'; document.getElementById(\'menu_table_'+login+'\').style.display=\'none\';" onmouseover="this.className=\'menu_hover\';" onmouseout="this.className=\'menu_def\';" onselectstart="return false;" class="menu_def"><img src="./theme/<?echo$skin;?>/icons/chat-vis.gif" width="16" height="16" border="0" hspace="5" align="middle"> <?echo$lang['ignore'];?></td></tr>'; }
  else if (ignor == '1')
  { document_write += '<tr><td onclick="window.parent.frames[\'hidden\'].location.href=\'hidden.php?unignore='+name+'\'; document.getElementById(\'menu_table_'+login+'\').style.display=\'none\';" onmouseover="this.className=\'menu_hover\';" onmouseout="this.className=\'menu_def\';" onselectstart="return false;" class="menu_def"><img src="./theme/<?echo$skin;?>/icons/chat-ign.gif" width="16" height="16" border="0" hspace="5" align="middle"> <?echo$lang['unignore'];?></td></tr>'; }
  if (name != '<?echo$_SESSION['suser'];?>' & bals>=500)
    {
    document_write += '<tr><td onclick="compl(\''+name+'\'); document.getElementById(\'menu_table_'+login+'\').style.display=\'none\';" onmouseover="this.className=\'menu_hover\';" onmouseout="this.className=\'menu_def\';" onselectstart="return false;" class="menu_def"><img src="./theme/<?echo$skin;?>/icons/chat-compl.gif" width="16" height="16" border="0" hspace="5" align="middle"> <?echo$lang['addcompl'];?></td></tr>';
    }

<?if($_SESSION['balls']>=500){?>
      document_write += '<tr><td onclick="adm_warn(\''+name+'\');document.getElementById(\'menu_table_'+login+'\').style.display=\'none\';" onmouseover="this.className=\'menu_hover\';" onmouseout="this.className=\'menu_def\';" onselectstart="return false;" class="menu_def"><img src="./theme/<?echo$skin;?>/icons/chat-war.gif" width="16" height="16" border="0" hspace="5" align="middle"> <?echo$lang['addwarn'];?></td></tr>';
    if (ban == '0') { document_write += '<tr><td onclick="adm_ban(\''+name+'\',\''+ip+'\',\''+soft+'\');document.getElementById(\'menu_table_'+login+'\').style.display=\'none\';" onmouseover="this.className=\'menu_hover\';" onmouseout="this.className=\'menu_def\';" onselectstart="return false;" class="menu_def"><img src="./theme/<?echo$skin;?>/icons/chat-ban.gif" width="16" height="16" border="0" hspace="5" align="middle"> <?echo$lang['addban'];?></td></tr>'; }
    else { document_write += '<tr><td onclick="window.parent.frames[\'hidden\'].location.href=\'hidden.php?unban='+name+'&ips='+ip+'\'; document.getElementById(\'menu_table_'+login+'\').style.display=\'none\';" onmouseover="this.className=\'menu_hover\';" onmouseout="this.className=\'menu_def\';" onselectstart="return false;" class="menu_def"><img src="./theme/<?echo$skin;?>/icons/chat-unban.gif" width="16" height="16" border="0" hspace="5" align="middle"> <?echo$lang['delban'];?></td></tr>'; }
<?}?>
  document_write += '</table>';

  window.parent.frames['users'].document.getElementById("usr").innerHTML += document_write;
 }

 var rightedge = document.body.clientWidth-event.clientX;
 if (rightedge < (window.parent.frames['users'].document.getElementById('menu_table_'+login).scrollWidth+10)) { pad_left = document.body.scrollLeft+event.clientX-(window.parent.frames['users'].document.getElementById('menu_table_'+login).scrollWidth+10); }
 else { pad_left = document.body.scrollLeft+event.clientX; }

 var bottomedge=document.body.clientHeight-event.clientY;
 if (bottomedge < (window.parent.frames['users'].document.getElementById('menu_table_'+login).scrollHeight+10)) { pad_top = document.body.scrollTop+event.clientY-(window.parent.frames['users'].document.getElementById('menu_table_'+login).scrollHeight+10); }
 else { pad_top = document.body.scrollTop+event.clientY; }

 window.parent.frames['users'].document.getElementById('menu_table_'+login).style.left=pad_left;
 window.parent.frames['users'].document.getElementById('menu_table_'+login).style.top=pad_top;
 window.parent.frames['users'].document.getElementById('menu_table_'+login).style.display='block';

 if (oldest_menu != '') { window.parent.frames['users'].document.getElementById('menu_table_'+oldest_menu).style.display = 'none'; }
 oldest_menu = login;
}

function show_hide (ID)
{
 var ID;
 if(document.getElementById(ID).style.display == 'none') { document.getElementById(ID).style.display = ''; }
 else { document.getElementById(ID).style.display = 'none'; }
}

function menu_right (ID)
{
 var ID;
 show_hide(ID);
 if(document.getElementById(ID).style.display == 'none') { document.getElementById('img_'+ID).src = './theme/<?echo$skin;?>/img/st_d.gif'; }
 else { document.getElementById('img_'+ID).src = './theme/<?echo$skin;?>/img/st_u.gif'; }
 mess_focus();
 return false;
}

function insSmile(smile)
{
 var smile;
 parent.frames["send"].document.send_form.message.value += ' '+smile+' ';
 mess_focus();
}


// Декодируем фиговые символы
var ar_chr = new Array();
for (var i=1;i<=255;i++)ar_chr[i]=unescape('%' + i.toString(16));
function ar_C2ASCII(c) { for (var i=1;i<=255;i++) { if (ar_chr[i] == c)return i; } return c; }
function urlencode(text)
{
 var tmp = '';
 var n, i;
 for (i=0; i<text.length; i++)
 {
  n=ar_C2ASCII(text.charAt(i));
  if (n<=38 || (n>=58 && n<=64) || (n>=122 && n<=191)) { tmp += '%' + n.toString(16); }
  else { tmp += text.charAt(i); }
 }
 return tmp;
}
// end.

function message_clear()
{
 // window.parent.frames['messages'].document.getElementById("updacc").value="yes";
 window.parent.frames["send"].document.send_form.message.select();
 window.parent.frames["send"].document.send_form.message.value='';
 mess_focus();
}

function inner(type,fon,color,time,kto,komu,mess)
{
 var messages = '';
 var ktol = '';
 if (fon == '') { fon = '<?echo$color['bgcolor'];?>'; }
 if (color == '') { color = '<?echo$color['defcolor'];?>'; }
 if (komu == '') { type = 'no'; }

 if (kto != '<?echo$_SESSION['suser'];?>' && kto != '<?echo$bot_name;?>') { ktol = '<a href="#" onclick="to(\''+kto+'\');mess_focus();return false;" style="cursor:hand; color:'+color+';">'+kto+'</a>'; } else { ktol = '<a href="#" onclick="mess_focus();return false;" style="color:'+color+';">'+kto+'</a>'; }

 messages += '<div align="left" style="BackGround-color: '+fon+';">&nbsp;';
 messages += '<font size="1" color="<?echo$color['tdcolor'];?>">'+time+'</font>&nbsp;';
 if (type == 'yes') { messages += '<font color="'+color+'"><b>['+ktol+'&nbsp;»&nbsp;'+komu+']</b>&nbsp;<b>'+mess+'</b></font>'; }
 else
 {
  if (komu == '') { messages += '<font color="'+color+'"><b>['+ktol+']</b></a>&nbsp;'+mess+'</font>'; }
  else { messages += '<font color="'+color+'"><b>['+ktol+'&nbsp;»&nbsp;'+komu+']</b></a>&nbsp;'+mess+'</font>'; }
 }
 messages += '</div>';

<?
if($_SESSION['nm']=="up")
  {
  echo 'window.parent.frames["messages"].document.getElementById("msgs").innerHTML = messages + window.parent.frames["messages"].document.getElementById("msgs").innerHTML;';
  }
else
  {
  echo 'window.parent.frames["messages"].document.getElementById("msgs").innerHTML += messages;';
  echo 'window.parent.frames["messages"].scrollBy(1,3000);';
  echo '//setInterval("window.parent.frames[\'messages\'].scrollBy(1,1000);", 10);';
  }
?>

}

function add_user(name, bals, ignore, ban, ip, sid, soft)
{
 var id = 0;
 if (bals == '') { bals = '0'; }
 if (ignore == '') { ignore = '0'; }
 if (ban == '') { ban = '0'; }

 var user_icon = 'user.gif';
      if (bals >= '999' && ban == '0') { user_icon = 'admin.gif'; }
 else if (bals >= '500' && ban == '0') { user_icon = 'moder.gif'; }
 else if (ban != '0') { user_icon = 'bans.gif'; }

 var user = document.createElement('div');
 user.setAttribute('id', name);
 window.parent.frames["users"].document.getElementById("usr").appendChild(user);

 var users = '<a href="#" onclick="users_menu_show(\''+name+'\',\''+bals+'\',\''+ignore+'\',\''+ban+'\',\''+ip+'\',\''+sid+'\',\''+soft+'\'); return false;"><img src="./theme/orange/icons/'+user_icon+'" align="middle" border="0" width="16" height="16" hspace="1"></a>';
 users += '&nbsp;<a href="#" onclick="to(\''+name+'\'); return false;"><b>'+name+'</b></a>&nbsp;';
 window.parent.frames["users"].document.getElementById("usr").getElementById(user).innerHTML += users;
}


function iusers(name, balls, status, ignore, ban, ip, sid, soft)
{
 var id = 0;
 if (balls == '') { bals = '0'; }
 if (ignore == '') { ignore = '0'; }
 if (ban == '') { ban = '0'; }

 var user_icon = 'user.gif';
 var user_text = '<?echo$lang['user'];?>';
      if (balls >= '999' && ban == '0') { user_icon = 'admin.gif'; user_text = '<?echo$lang['administrator'];?>'; }
 else if (balls >= '700' && ban == '0') { user_icon = 'moder2.gif'; user_text = '<?echo$lang['moderator1'];?>'; }
 else if (balls >= '500' && ban == '0') { user_icon = 'moder.gif'; user_text = '<?echo$lang['moderator2'];?>'; }
 else if (ban != '0') { user_icon = 'bans.gif'; }
 var status_icon = 'free.gif';
 var status_text = 'свободен для чата';
      if (status == 'away') { status_icon = 'away.gif'; status_text = 'временно отшёл'; }
 else if (status == 'na') { status_icon = 'na.gif'; status_text = 'не доступен'; }
 else if (status == 'dnd') { status_icon = 'dnd.gif'; status_text = 'не беспокоить'; }
 var users = '<div>';
 users += '<a href="#" onclick="users_menu_show(\''+name+'\',\''+balls+'\',\''+ignore+'\',\''+ban+'\',\''+ip+'\',\''+sid+'\',\''+soft+'\'); return false;" title="'+user_text+'"><img src="./theme/<?echo$skin;?>/icons/'+user_icon+'" align="middle" border="0" width="16" height="16" hspace="1"></a>';
 users += '&nbsp;<a href="#" onclick="to(\''+name+'\'); return false;"><b>'+name+'</b></a>&nbsp;';
 users += '<img src="./theme/<?echo$skin;?>/status/'+status_icon+'" align="middle" border="0" width="16" height="16" hspace="1" alt="'+status_text+'">';
 users += '</div>';
 window.parent.frames["users"].document.getElementById("usr").innerHTML += users;
}

function mutetimer()
  {
  if(mutetime_rem > 0)
    {
    mutetime_rem--;
    mins = Math.floor(mutetime_rem / 60);
    secs = mutetime_rem % 60;
    if(secs < 10) secs = '0' + secs;
    if(mins < 10) mins = '0' + mins;
    window.parent.frames["send"].document.getElementById('muteremtime2').innerHTML = '<b>' + mins + ':' + secs + ' минут</b> <button name="l" id="l" onclick="logout();">Выйти</button><br><br>';
    get_mute_timer = setTimeout('mutetimer(mutetime_rem)',1000);
    }
  else
    {
    window.parent.frames["send"].document.getElementById('muteremtime2').innerHTML = "";
    window.parent.frames["send"].document.getElementById('muteremtime').innerHTML = "";
    mess_focus();
    }
  }

function ban(name,moder,reson,mtime)
{
 var bans = '&nbsp;Вы были забанены модератором <b>'+moder+'</b>. Причина: <b>'+reson+'</b>. Осталось молчать: ';
 window.parent.frames["send"].document.getElementById("muteremtime").innerHTML = bans;
 clearTimeout(get_mute_timer);
 mutetime_rem = mtime;
 mutetimer(mutetime_rem);
}

function to(user)
{
 var user;
 if (user != '<?echo$_SESSION['suser'];?>')
 {
  window.parent.frames["send"].document.send_form.to.value=user;
  mess_focus();
 }
 else
 {
  alert('<?echo$lang['notnick'];?>');
  window.parent.frames["send"].document.send_form.to.value='';
  mess_focus();
 }
}

function userinfo(name)
  {
  window.open('userinfo.php?user='+name,'info','Width=800,Height=750,toolbar=0,status=0,border=0,scrollbars=0');
  //window.ban_add.moveTo((screen.width-530)/2 , ((screen.height-302)/2)-50);
  }

function compl(he)
  {
  var he;
  window.open("./compl.php?login="+he+"","compl","width=530,height=302,top=0,left=0,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no");
  //window.ban_add.moveTo((screen.width-530)/2 , ((screen.height-302)/2)-50);
  }

<?if($_SESSION['balls']>=500){?>
function adm_ban(he,ip)
  {
  var he;
  var ip;
  window.open("./ban.php?mode=add&login="+he+"&ips="+ip,"ban_add","width=530,height=302,top=0,left=0,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no");
  //window.ban_add.moveTo((screen.width-530)/2 , ((screen.height-302)/2)-50);
  }

function adm_warn(he)
  {
  var he;
  window.open("./ban.php?mode=addwarn&login="+he+"","ban_warn","width=530,height=302,top=0,left=0,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no");
  //window.ban_add.moveTo((screen.width-530)/2 , ((screen.height-302)/2)-50);
  }

function ban_list()
  {
  window.open("./ban.php?mode=list","ban_list","width=750,height=500,top=0,left=0,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no");
  //window.ban_list.moveTo((screen.width-750)/2 , ((screen.height-500)/2)-50);
  }

function ban_logs()
  {
  window.open("./ban.php?mode=logs","ban_logs","width=750,height=500,top=0,left=0,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no");
  //window.ban_list.moveTo((screen.width-750)/2 , ((screen.height-500)/2)-50);
  }
<?}?>
 -->
</script>
</head>
<?
if($_SESSION['send']=="up")
 {?>
<frameset rows="121, 26, *, 0" framespacing="0" frameborder="0"> <frame frameborder="0" noresize scrolling="no" name="header" src="./index.php?file=header">
  <frame frameborder="0" noresize scrolling="no" name="send" src="./index.php?file=send"> <frameset cols="*, 203" framespacing="0" frameborder="0">
  <frame frameborder="0" noresize scrolling="auto" name="messages" src="./index.php?file=messages">
  <frameset rows="*, 0" framespacing="0" frameborder="0">
   <frame frameborder="0" noresize scrolling="auto" name="users" src="./index.php?file=users">
  </frameset>
 </frameset>
  <frame frameborder="0" framespacing="0" noresize scrolling="no" name="hidden" src="">
</frameset><?
 }
elseif($_SESSION['send']=="down")
 {?>
<frameset rows="121, *, 26, 0" framespacing="0" frameborder="0">
 <frame frameborder="0" noresize scrolling="no" name="header" src="./index.php?file=header">
  <frameset cols="*, 203" framespacing="0" frameborder="0">
  <frame frameborder="0" noresize scrolling="auto" name="messages" src="./index.php?file=messages">
  <frameset rows="*, 0" framespacing="0" frameborder="0">
   <frame frameborder="0" noresize scrolling="auto" name="users" src="./index.php?file=users">
  </frameset>
 </frameset>
 <frame frameborder="0" noresize scrolling="no" name="send" src="./index.php?file=send">
  <frame frameborder="0" framespacing="0" noresize scrolling="no" name="hidden" src="">
</frameset><?
 }
?>
</HTML>