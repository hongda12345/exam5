<?php
include 'db.php';
$sid = $_REQUEST['sid'];
$sname = $_REQUEST['sname'];
$did = $_REQUEST['did'];
$sql="update stage set sname='{$sname}',did='{$did}' where sid = $sid";
$data=$mysql->query($sql);
if($mysql->affected_rows){
    echo 'ok',
    exit;
}
echo 'error';