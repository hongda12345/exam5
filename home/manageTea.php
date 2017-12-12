<?php
include 'db.php';
$sql="select teacher.*,class.cname,stage.sname,direction.dname from teacher,class,stage,direction where teacher.did=direction.did and teacher.sid=stage.sid and teacher.cid=class.cid";
$data=$mysql->query($sql)->fetch_all(1);
echo json_encode($data);