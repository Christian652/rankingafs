<?php  
session_start();
session_unset();
$_SESSION['msg'] = "DESLOGADO DO SISTEMA COM SUCESSO!!!";
$_SESSION['cor'] = "info";

header('Location: index.php');

