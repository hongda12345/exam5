<?php
include 'db.php';
$sql="select student.*,class.cname,stage.sname,direction.dname from student,class,stage,direction where student.did=direction.did and student.sid=stage.sid and student.cid=class.cid";
$data=$mysql->query($sql)->fetch_all(MYSQLI_ASSOC);
echo json_encode($data);