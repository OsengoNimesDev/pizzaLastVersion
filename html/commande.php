<?php 
    if(!isset($_SESSION)) session_start();  
    $type=filter_input(INPUT_POST, 'type');
    $id=filter_input(INPUT_POST, 'id');
    $val=filter_input(INPUT_POST, 'val');
    $_SESSION[$type][$id]=$val;

    echo json_encode($_SESSION);

