<?php


include ("../inc/connect.php");

session_start();
session_destroy();
header('Location: index.php');
exit;