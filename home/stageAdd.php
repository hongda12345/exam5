<?php
include 'db.php';
$sname=$_REQUEST['sname'];
$did=$_REQUEST['value'];
$sql="insert into stage (sname,did) values ('{$sname}','{$did}')";
$data=$mysql->query($sql);
if($mysql->affected_rows){
    echo 'ok';
    exit;
}
echo 'error';