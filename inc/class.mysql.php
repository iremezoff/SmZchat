<?
#########################################################
################### class for mySQL  ####################
################### version: 1.0.0   ####################
################### create: 20.08.06 ####################
#########################################################

class operations
  {
  public $table;
  public $vars;
  public $errors;
  public $total;
  public $result;
  public $query;

  function check_empty($var,$str)
    {
    if(empty($var)) $this->errors.="$str<br>";
    return;
    }

  function check_mail($var,$str)
    {
    $pattern="/^[a-zA-Z0-9_]+(([a-zA-Z0-9_.-]+)?)@[a-zA-Z0-9+](([a-zA-Z0-9_.-]+)?)+\.+[a-zA-Z]{2,4}$/";
    if(!preg_match($pattern,$var)) $this->errors.="$str<br>";
    return;
    }

  function check_url($var,$str)
    {
    $pattern="(http://.[-a-zA-Z0-9@:%_\+.~#?&//=]+)";
    if(!eregi($pattern,$var)) $this->errors.="$str<br>";
    return;
    }
   
  function select($where,$order=null,$limit=null)
    {
    if(empty($where)) $where=1;
    if(empty($order)) $order="id asc";
    if(!empty($limit)) $limit="limit $limit";
    if(is_array($this->vars))
      {
      $record="";
      $i=0;
      foreach($this->vars as $val)
        {
        if($i==0) $record.=$val;
        else $record.=", $val";
        $i++;
        }
      }
    else $record=$this->vars;
    $query="select $record from $this->table where $where order by $order $limit";
    $this->result=mysql_query($query);
    $this->query=$query;
    $mysqlerr=mysql_error();
    if(!empty($mysqlerr))
      $this->total=$mysqlerr.":::".$query;
    return;
    }

  function insert($str)
    {
    $field=$ins="(";
    $i=0;
    foreach($this->vars as $key=>$val)
      {
      if($i==0) { $field.=$key; $ins.="'$val'"; }
      else
        {
        $field.=", $key";
        $ins.=", '".mysql_escape_string($val)."'";
        }
      $i++;
      }
    $field.=")";
    $ins.=");";
    $query="insert into $this->table $field values $ins";
    mysql_query($query);
    $this->query=$query;
    $mysqlerr=mysql_error();
    if(empty($mysqlerr))
      $this->total=$str;
    else
      $this->total=mysql_error().":::".$query;
    return;
    }

  function update($where,$str)
    {
    if(empty($where)) $where=1;
    $upds="";
    $i=0;
    foreach($this->vars as $key=>$val)
      {
      if($i==0) $upds.="$key='$val'";
      else $upds.=", $key='".mysql_escape_string($val)."'";
      $i++;
      }
    $query="update $this->table set $upds where $where";
    mysql_query($query);
    $this->query=$query;
    $mysqlerr=mysql_error();
    if(empty($mysqlerr))
      $this->total=$str;
    else
      $this->total=mysql_error().":::".$query;
    return;
    }

  function delete($where,$str)
    {
    if(empty($where)) $where=1;
    $query="delete from $this->table where $where";
    mysql_query($query);
    $this->query=$query;
    if(empty($mysqlerr))
      $this->total=$str;
    else
      $this->total=mysql_error().":::".$query;
    return;
    }
  }
?>