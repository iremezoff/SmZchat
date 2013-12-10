<table border="0" bgcolor="<?echo$color['bgcolor2'];?>" cellpadding="1" cellspacing="0" align="center" style="width:100%;height:100%;" width="100%" height="100%">
<form name="send_form" id="send_form" method="post" target="hidden" action="hidden.php" onSubmit="return tester();"><input name="color" value="00ff00" type="hidden"><input name="new_mess" value="all" type="hidden">
<tr valign="bottom"><td style="width: 132;" nowrap><input name="to" style="width:130px; cursor:hand;" title="<?echo$lang['clear'];?>" value="" onclick="JavaScript: document.send_form.to.value='';" readonly>
<td><input type="text" id="message" name="message" width="100%" style="width: 100%" maxlength="400" onkeypress="if(event.keyCode==13){submited();}"></td>
</form>
<td style="width:86;" nowrap><button name="s" id="s" onclick="submited(); return false;"><?echo$lang['send'];?></button></td>
<td style="width:86;" nowrap><button name="p" id="p" onclick="submited('p'); return false;"><?echo$lang['private'];?></button></td>
<td style="width:86;" nowrap><button name="l" id="l" onclick="logout();"><?echo$lang['exit'];?></button></td>
</tr></table>