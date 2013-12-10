<?
if(substr_count($msg,"/big ")>0) $msg="<big>".str_replace("/big","",$msg)."</big>";
if(substr_count($msg,"/small ")>0) $msg="<small>".str_replace("/small","",$msg)."</small>";
if(substr_count($msg,"/tt ")>0) $msg="<tt>".str_replace("/tt","",$msg)."</tt>";
if(substr_count($msg,"/s ")>0) $msg="<s>".str_replace("/s","",$msg)."</s>";
if(substr_count($msg,"/b ")>0) $msg="<b>".str_replace("/b","",$msg)."</b>";
if(substr_count($msg,"/i ")>0) $msg="<i>".str_replace("/i","",$msg)."</i>";
if(substr_count($msg,"/u ")>0) $msg="<u>".str_replace("/u","",$msg)."</u>";
if(substr_count($msg,"/sup ")>0) $msg="<sup>".str_replace("/sup","",$msg)."</sup>";
if(substr_count($msg,"/sub ")>0) $msg="<sub>".str_replace("/sub","",$msg)."</sub>";
?>