<?php
include 'db.php';
$pname=$_REQUEST['pname'];
$cid=$_REQUEST['cid'];
$author=$_REQUEST['author'];
$sql="insert into paper (pname,cid,author) values ('{$pname}','{$cid}','{$author}')";
$data=$mysql->query($sql);
if($mysql->affected_rows){
    echo 'ok';
    exit;
}
echo 'error';