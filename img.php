<?
define("C_MOD",1);
include("inc/functions.php");

srand(time());
session_register("registr_key");

$_SESSION['registr_key']="";
for($i=1;$i<=6;$i++)
  {
  $_SESSION['registr_key'].=$array_rand[array_rand($array_rand,1)];
  }

if($type_str==2)
  {
  $image="design/regcode.png";
  $img=imagecreatefrompng($image);
  $black=imagecolorallocate($img,rand(0,155),rand(0,155),rand(0,155)); 
  $white=imagecolorallocate($img,rand(156,255),rand(156,255),rand(156,255)); 
  for($i=0;$i<6;$i++)
    {
    imagestring($img, 5, $i*23+3, rand(1,30), substr($_SESSION['registr_key'],$i,1), $black);
    }
  $p=0;
  $_SESSION['registr_key']=md5($_SESSION['registr_key']);
  while($p<$noise) 
    { 
    $x=mt_rand(1,130);
    $y=mt_rand(1,70);
    @$pixel=imagecolorat($img,$x,$y);
    $point=($pixel==$black)?$white:$black;
    imagesetpixel($img,$x,$y,$point);
    $p++; 
    } 
  imagepng($img);
  imagedestroy($img);
  }
elseif($type_str==3)
  {
  $img=imagecreate(130,70); 
  $black=imagecolorallocate($img,rand(0,155),rand(0,155),rand(0,155)); 
  $white=imagecolorallocate($img,rand(156,255),rand(156,255),rand(156,255)); 
  imagefill($img,0,0,$white);
  for($i=0;$i<6;$i++)
    {
    imagettftext($img,18,rand(-20,20),4+$i*20,rand(25,65),$black,"./fonts/$font.ttf",substr($_SESSION['registr_key'],$i,1)); 
    }
  $p=0;
  $_SESSION['registr_key']=md5($_SESSION['registr_key']);
  while($p<$noise) 
    { 
    $x=mt_rand(1,130);
    $y=mt_rand(1,70);
    @$pixel=imagecolorat($img,$x,$y);
    $point=($pixel==$black)?$white:$black;
    imagesetpixel($img,$x,$y,$point);
    $p++; 
    } 
  imagepng($img); 
  imagedestroy($img); 
  }
else
  {
  $img=imagecreate(130,70); 
  $white=imagecolorallocate($img,255,255,255); 
  imagefill($img,0,0,$white);
  imagepng($img); 
  }
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>