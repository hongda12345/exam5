<?php
include 'db.php';
$tid = $_POST['tid'];
$sql="delete from type where tid=$tid";
$data=$mysql->query($sql);
if($mysql->affected_rows){
    echo 'ok';
    exit;
}
echo 'error';