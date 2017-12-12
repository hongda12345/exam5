<?php
include 'db.php';
$tid=$_REQUEST['tid'];
$sid=$_REQUEST['sid'];
$type=$_REQUEST['type'];
$title=$_REQUEST['title'];
$exp=$_REQUEST['exp'];
$answer=$_REQUEST['answer'];
$score=$_REQUEST['score'];
$sql="UPDATE test SET sid='{$sid}',type='{$type}',title='{$title}',exp='{$exp}',answer='{$answer}',score='{$score}' WHERE tid=$tid";
$mysql->query($sql);
if($mysql->affected_rows){
    echo 'ok';
}else{
    echo 'error';
}