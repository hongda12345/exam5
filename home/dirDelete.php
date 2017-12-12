<?php
include 'db.php';
$did = $_POST['did'];
$sql="delete from direction where did=$did";
$data=$mysql->query($sql);
if($mysql->affected_rows){
    echo 'ok';
    exit;
}
echo 'error';