<?php/*
    //session_start();

    if (!isset($_SESSION['lang']))
        $_SESSION['lang'] = "en";
    else if (isset($_GET['lang']) && $_SESSION['lang'] != $_GET['lang'] && !empty($_GET['lang'])){
        if ($_GET['lang'] == "en")
            $_SESSION['lang'] = "en";
        elseif ($_GET['lang'] == "it")
            $_SESSION['lang'] = "it";
        elseif ($_GET['lang'] == "de")
            $_SESSION['lang'] = "de";
    }

    require_once "messages/".$_SESSION['lang']. ".php";
?>
