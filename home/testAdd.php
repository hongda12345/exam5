<?php
include 'db.php';
$data=$_REQUEST;
$keys=array_keys($data);
$str='(';
for($i=0;$i<count($keys);$i++){
    $str.=$keys[$i].',';
}
$str.='author) values (';
foreach($data as $v){
    $str.="'{$v}',";
}
session_start();
$str.="'".$_SESSION['user']."')";
$sql="insert into test $str";
$mysql->query($sql);
if($mysql->affected_rows){
    echo 'ok';
}else{
    echo 'error';
}