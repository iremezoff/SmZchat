<?
#########################################################
################### class for upload Image ##############
################### version: 1.0.0         ##############
################### create: 30.08.06       ##############
#########################################################
class uploadimg
  {
  var $image;
  var $image_name;
  var $size;
  var $width_max;
  var $height_max;
  var $size_max;
  var $width_to;
  var $height_to;
  var $errors;
  var $load_small=0;
  var $path1;
  var $path2;
  var $total;
  var $width;
  var $height;
  var $ext;
  var $exts=array("jpg","gif","png");
  var $lang=array();

  function setPars()
    {
    $this->errors="";
    $permits=getimagesize($this->image);
    $image_name_arr=explode(".",$this->image_name);
    $this->width=$permits[0];
    $this->height=$permits[1];
    $this->ext=strtolower(end($image_name_arr));
    return;
    }

  function check_pars()
    {
    if(!(in_array($this->ext,$this->exts))) $this->errors.=$lang['error']['ext']."<br>";
    if($this->width>$this->width_max) $this->errors.=str_replace("%s",$this->width_max,$lang['error']['width'])."<br>";
    if($this->height>$this->height_max) $this->errors.=str_replace("%s",$this->height_max,$lang['error']['height'])."<br>";
    if($this->size>$this->size_max) $this->errors.=str_replace("%s",$this->size_max,$lang['error']['size'])."<br>";
    return;
    }

  function check_empty($var,$str)
    {
    if(empty($var)) $this->errors.="$str<br>";
    return;
    }

  function resize($filename,$smallimage,$w,$h) 
    { 
    $ratio=$w/$h;
    $size_img=getimagesize($filename);
    if(($size_img[0]<$w) && ($size_img[1]<$h)) return true;
    $src_ratio=$size_img[0]/$size_img[1];
    if($ratio<$src_ratio) $h=$w/$src_ratio;
    else $w=$h*$src_ratio;
    $dest_img=imagecreatetruecolor($w,$h);
    $white=imagecolorallocate($dest_img, 255, 255, 255);
    if($size_img[2]==2) $src_img=imagecreatefromjpeg($filename);
    elseif($size_img[2]==1) $src_img=imagecreatefromgif($filename);
    elseif($size_img[2]==3) $src_img=imagecreatefrompng($filename);
    imagecopyresampled($dest_img, $src_img, 0, 0, 0, 0, $w, $h, $size_img[0], $size_img[1]);
    if($size_img[2]==2) imagejpeg($dest_img, $smallimage);
    elseif($size_img[2]==1) imagegif($dest_img, $smallimage);
    elseif($size_img[2]==3) imagepng($dest_img, $smallimage);
    imagedestroy($dest_img);
    imagedestroy($src_img);
    return true;
    }

  function upload()
    {
    $image_name=strtolower($_SESSION['suser']);
    $img=$this->path1."/".$image_name.".".$this->ext;
    $img_small=$this->path2."/".$image_name.".".$this->ext;
    if(file_exists($img)) unlink($img);
    if(file_exists($img_small)) unlink($img_small);
    if(@copy($this->image,$img)) 
      {
      unlink($this->image);
      chmod($img, 0644);
      if($this->load_small==1)
        if(!$this->resize($img,$img_small,$this->width_to,$this->height_to)) $this->total=$lang['error']['small'];
      $this->total=$lang['complete']['load'];
      }
    else
      $this->total=$lang['error']['copy'];
    return;
    }
  }
?>