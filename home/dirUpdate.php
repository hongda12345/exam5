<?php
include 'db.php';
$did = $_REQUEST['did'];
$dname = $_REQUEST['dname'];
$sql="update direction set dname='${dname}' where did = $did";
$data=$mysql->query($sql);
if($mysql->affected_rows){
    echo 'ok',
    exit;
}
echo 'error';