<?php
include 'db.php';
//ids 是个数组
$uid=$_REQUEST['ids'];
//数组打散成字符串
$str=implode(',',$uid);
$sql="delete from student where uid in ($str)";
$mysql->query($sql);
if($mysql->affected_rows){
    echo 'ok';
}else{
    echo 'error';
}