<?php
include 'db.php';
$sid = $_POST['sid'];
$sql="delete from stage where sid=$sid";
$data=$mysql->query($sql);
if($mysql->affected_rows){
    echo 'ok';
    exit;
}
echo 'error';