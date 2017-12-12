<?php
include 'db.php';
$tid = $_REQUEST['tid'];
$tname = $_REQUEST['tname'];
$sql="update type set tname='${tname}' where tid = $tid";
$data=$mysql->query($sql);
if($mysql->affected_rows){
    echo 'ok',
    exit;
}
echo 'error';