<?php
include 'db.php';
$uid=$_REQUEST['uid'];
$mname=$_REQUEST['mname'];
$msex=$_REQUEST['msex'];
$mnum=$_REQUEST['mnum'];
$did=$_REQUEST['did'];
$sid=$_REQUEST['sid'];
$cid=$_REQUEST['cid'];
$sql="UPDATE student SET 
mname='{$mname}',
msex='{$msex}',
mnum='{$mnum}',
did='{$did}',
sid='{$sid}',
cid='{$cid}'
 WHERE uid=$uid";
$data=$mysql->query($sql);
if($mysql->affected_rows){
    echo 'ok';
}else{
    echo 'error';
}