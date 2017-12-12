<?php
include 'db.php';
//ids 是个数组
$tid=$_REQUEST['ids'];
//数组打散成字符串
$str=implode(',',$tid);
$sql="delete from teacher where tid in ($str)";
$mysql->query($sql);
if($mysql->affected_rows){
    echo 'ok';
}else{
    echo 'error';
}