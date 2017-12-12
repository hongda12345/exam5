<?php
include 'db.php';
$cname=$_REQUEST['cname'];
$did=$_REQUEST['value'];
$sql="insert into class (cname,did) values ('{$cname}','{$did}')";
$data=$mysql->query($sql);
if($mysql->affected_rows){
    echo 'ok';
    exit;
}
echo 'error';