<?php
include 'db.php';
$mname=$_REQUEST['mname'];
$msex=$_REQUEST['msex'];
$mnum=$_REQUEST['mnum'];
$did=$_REQUEST['did'];
$sid=$_REQUEST['sid'];
$cid=$_REQUEST['cid'];
$sql="INSERT INTO student (mname,mpass,msex,mnum,did,sid,cid) VALUES ('{$mname}',md5(12345),'{$msex}','{$mnum}','{$did}','{$sid}','{$cid}')";
$data=$mysql->query($sql);
if($mysql->affected_rows){
    echo 'ok';
    exit;
}
echo 'error';