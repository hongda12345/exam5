<?php
include 'db.php';
$mname=$_REQUEST['mname'];
$tsex=$_REQUEST['tsex'];
$tnum=$_REQUEST['tnum'];
$did=$_REQUEST['did'];
$sid=$_REQUEST['sid'];
$cid=$_REQUEST['cid'];
$sql="INSERT INTO teacher (mname,tsex,tnum,cid,sid,did,mpass) VALUES ('{$mname}','{$tsex}','{$tnum}','{$cid}','{$sid}','{$did}',md5(12345))";
$data=$mysql->query($sql);
if($mysql->affected_rows){
    echo 'ok';
    exit;
}
echo 'error';