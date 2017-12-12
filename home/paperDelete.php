<?php
include 'db.php';
//ids 是个数组
$pid=$_REQUEST['ids'];
//数组打散成字符串
$str=implode(',',$pid);
$sql="delete from paper where pid in ($str)";
$mysql->query($sql);
if($mysql->affected_rows){
    echo 'ok';
}else{
    echo 'error';
}