<?
define("C_MOD",1);
include("inc/functions.php");

$query_cats=mysql_query("select * from chat_rules_cats order by id");
echo "<h2>$lang[rules]</h2>";
echo "<ol type=\"1\">";
while($array_cats=mysql_fetch_array($query_cats))
  {
  echo "<li><b>$array_cats[categ]</b></li>";
  echo "<ol type=\"a\">";
  $query_rules=mysql_query("select * from chat_rules where id_cat='$array_cats[id]' order by id");
  while($array_rules=mysql_fetch_array($query_rules))
    {
    echo "<li>$array_rules[content]</li>";
    }
  echo "</ol></li>";
  }
echo "</ol>";
?>
