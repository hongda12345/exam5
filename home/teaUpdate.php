<?php
include 'db.php';
$tid=$_REQUEST['tid'];
$mname=$_REQUEST['mname'];
$tsex=$_REQUEST['tsex'];
$tnum=$_REQUEST['tnum'];
$did=$_REQUEST['did'];
$sid=$_REQUEST['sid'];
$cid=$_REQUEST['cid'];
$sql="UPDATE teacher SET 
mname='{$mname}',
tsex='{$tsex}',
tnum='{$tnum}',
did='{$did}',
sid='{$sid}',
cid='{$cid}'
 WHERE tid=$tid";
$data=$mysql->query($sql);
if($mysql->affected_rows){
    echo 'ok';
}else{
    echo 'error';
}