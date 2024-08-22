<?php include ("../inc/connect.php");

ob_start();
$pageid = $_GET['page'];
$sql = "Delete FROM page  Where page_id = $pageid";
// use exec() because no results are returned
$conn->exec($sql);
echo "New record created successfully";
header("Location: view-page.php");
exit;



