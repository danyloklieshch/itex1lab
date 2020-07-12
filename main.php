<?php
$link =new PDO('mysql:host=localhost;dbname=workers','root','');
$profession = trim($_REQUEST['prof']);
$name = trim($_REQUEST['name']);
$value1 = trim($_REQUEST['value1']);
$value2 = trim($_REQUEST['value2']);
$name2 = trim($_REQUEST['name2']);

if($profession=="начальник отдела"){
    $sql = "SELECT department.chief, work.FID_Worker ,work.time_start ,work.time_end FROM worker,department,work WHERE chief='$name'";
    foreach ($link->query($sql) as $row) {
        echo $row['chief'] . '&nbsp;'   ;
        echo $row['FID_Worker'] . '&nbsp;'   ;
        echo $row['time_start'] . '&nbsp;'  ;
        echo $row['time_end'] . '&nbsp;'  . '</br>' ;
    }
}
elseif($profession=="менеджер проекта"){
    $sql = "SELECT projects.manager, work.FID_Worker ,work.time_start ,work.time_end FROM department,work,projects WHERE name='$name' AND FID_Worker='$name2' ";

    foreach ($link->query($sql) as $row) {
        echo $row['FID_Worker'] . '&nbsp;'   ;
        echo $row['time_start'] . '&nbsp;'  ;
        echo $row['time_end'] . '&nbsp;'  . '</br>' ;
    }}
elseif($profession=='разработчик'){

    $sql= $link->prepare("UPDATE work SET time_start='$value1', time_end='$value2' WHERE FID_Projects=$name2");
    $sql->bindParam(':name', $name);
    $sql->execute();
    echo 'Success';
}
