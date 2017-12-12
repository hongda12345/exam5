<?php
include 'db.php';
$data=$_POST;
$keys=array_keys($data);
$str='(';
for($i=0;$i<count($keys);$i++){
    $str.=$keys[$i].',';
}
$str=substr($str,0,-1);
$str.=') values (';
foreach($data as $v){
    $str.="'{$v}',";
}
$str=substr($str,0,-1);
$str.=')';
$sql="insert into type $str";
$data=$mysql->query($sql);
if($mysql->affected_rows){
    echo 'ok';
    exit;
}
echo 'error';