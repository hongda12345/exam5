<?php
include 'db.php';
$sql="select test.*,stage.sname,type.tname from test,stage,type where test.sid=stage.sid and test.type=type.tid";
$data=$mysql->query($sql)->fetch_all(MYSQLI_ASSOC);
echo json_encode($data);