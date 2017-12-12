<?php
include 'db.php';
$cid = $_REQUEST['cid'];
$cname = $_REQUEST['cname'];
$did = $_REQUEST['did'];
$sql="update class set cname='{$cname}',did='{$did}' where cid = $cid";
$data=$mysql->query($sql);
if($mysql->affected_rows){
    echo 'ok',
    exit;
}
echo 'error';