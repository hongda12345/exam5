<?php
include 'db.php';
$sql="select stage.sid,stage.sname,direction.dname from stage,direction where stage.did=direction.did";
$data=$mysql->query($sql)->fetch_all(MYSQLI_ASSOC);
echo json_encode($data);