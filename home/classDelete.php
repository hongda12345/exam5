<?php
include 'db.php';
$cid = $_POST['cid'];
$sql="delete from class where cid=$cid";
$data=$mysql->query($sql);
if($mysql->affected_rows){
    echo 'ok';
    exit;
}
echo 'error';