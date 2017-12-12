<?php
include 'db.php';
$pid=$_REQUEST['pid'];
$cid=$_REQUEST['cid'];
$pname=$_REQUEST['pname'];
$sql="UPDATE paper SET pid='{$pid}',cid='{$cid}',pname='{$pname}' WHERE pid=$pid";
$mysql->query($sql);
if($mysql->affected_rows){
    echo 'ok';
}else{
    echo 'error';
}