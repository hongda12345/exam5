<?php
include 'db.php';
session_start();
$cid=$_SESSION['cid'];
$uid=$_SESSION['uid'];
$sql1="select * from (select paper.*,class.cname from paper,class where paper.cid=class.cid) as lx where pid not in (select distinct pid from record where user=$uid)";
$data=$mysql->query($sql1)->fetch_all(MYSQLI_ASSOC);
echo json_encode($data);
