<?
if(!defined("F_MOD"))
  {
  echo "<meta http-equiv='refresh' content='0; url=/index.php'>";
  exit;
  }
$_SESSION['lst']=0;
?><HTML>
<HEAD>
<META content="text/html; charset=windows-1251" http-equiv="Content-Type">
<link href="theme/<?echo$skin;?>/main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" id="JS"></script>
<script type="text/javascript" language="JavaScript">
document.getElementById("JS").text = window.parent.document.getElementById("JS_all").text;
function hidrel()
{
 if (document.getElementById("updacc").value == "") { document.getElementById("updacc").value = "bzzzzzzzz"; }
 else
 {
  setTimeout("hidrel();",600);
  return false;
 }
 function radom () { return Math.round(Math.random()*100000); }
 readFile('./main.php?'+radom()+'='+radom());
 WriteText();
 setTimeout("hidrel();",<?echo$chat_refreshtime;?>);
 // setInterval("", 3000);
}
</script>
</HEAD>
<body bgcolor="<?echo$color['bgcolor'];?>" leftMargin="0" topMargin="0" rightMargin="0" marginheight="0" marginwidth="0" onload="hidrel();">
<div id="msgs" name="msgs"></div>
<input type="hidden" value="" id="updacc" name="updacc">
</body>
</HTML>