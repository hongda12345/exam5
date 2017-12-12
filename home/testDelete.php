<?php
include 'db.php';
$tid=$_REQUEST['tid'];
$sql="delete from test where tid=$tid";
$mysql->query($sql);
if($mysql->affected_rows){
    echo 'ok';
}else{
    echo 'error';
}