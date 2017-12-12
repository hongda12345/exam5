<?php
include 'db.php';
$pid=$_REQUEST['pid'];
$ids=$_REQUEST['ids'];
$str="";
for($i=0;$i<count($ids);$i++){
    $str.="(".$pid.",".$ids[$i].")";
}
$str=substr($str,0,-1);
$sql="insert into paperextra (pid,tid) values $str";
$data=$mysql->query($sql);
if($mysql->affected_rows){
    echo 'ok';
    exit;
}
echo 'error';