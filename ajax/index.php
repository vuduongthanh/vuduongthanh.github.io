<?php
include_once "../clas/deviceClass.php";
if(isset($_POST['apptoken'])){
    $deviceObj = new deviceClass($_POST['apptoken'], $_POST['md'], $_POST['mdm']);
    $deviceObj->removeDevice($_POST['id']);
}

//auth
if(isset($_POST['auth']) && !empty($_POST['auth'])){
    $authArr = json_decode($_POST['auth']);
    $appToken = $authArr[0]->value;
    $md = $authArr[1]->value;
    $mdm = $authArr[2]->value;
    $deviceObj = new deviceClass($appToken, $md, $mdm);

    echo "<h3>".$deviceObj->start()."</h3>";
	
	
}