<?
if(!defined("F_MOD"))
  {
  echo "<meta http-equiv='refresh' content='0; url=/index.php'>";
  exit;
  }
?><html>
<head>
<META HTTP-EQUIV="Content-Type" Content="text/html;Charset=Windows-1251">
<link href="theme/<?echo$skin;?>/main.css" rel="stylesheet" type="text/css">
<script id="JS"></script>
<script language="JavaScript">
<!--
document.getElementById("JS").text = window.parent.document.getElementById("JS_all").text;
function tester()
{
 var new_send = "new";
 var last_send = "last";
 //document.cookie="color="+document.send_form.color.value+";"
 var nwmess = document.send_form.message.value;
 if(nwmess != "")
 {
  new_send = document.send_form.to.value+nwmess;
  if(new_send == last_send)
  {
   alert("<?echo$lang['double'];?>");
   return false;
  }
  else
  {
   last_send = new_send;
   return true;
  }
 }
 else
 {
  alert("<?echo$lang['notmess'];?>");
  return false;
 }
}

function submited(type)
{
 var test= tester();
 if (test == true)
 {
  if (type=='p') { document.send_form.new_mess.value='privat'; } else { document.send_form.new_mess.value='all'; }
  window.parent.frames['hidden'].document.location.href='./blank.html';
  document.getElementById('s').disabled=true;
  document.getElementById('p').disabled=true;
  document.getElementById('send_form').submit();
  document.send_form.new_mess.value='all';
  mess_focus();
 }
 return false;
}
-->
</script>
</head>
<body bgcolor="<?echo$color['bgcolor2'];?>" onload="mess_focus();" leftMargin="0" topMargin="1" rightMargin="0" marginheight="0" marginwidth="0" <?echo$body;?>>
<span id="muteremtime" style="color:<?echo$color['bancolor'];?>;font-family:Verdana, Geneva, Arial, Helvetica, sans-serif; font-size:12px;"></span>
<span id="muteremtime2" style="color:<?echo$color['bancolor'];?>;font-family:Verdana, Geneva, Arial, Helvetica, sans-serif; font-size:12px;"></span>
<?include("theme/$skin/templs/send.tpl");?>
</body>
</html>