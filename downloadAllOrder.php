<?php
session_start();
include_once 'dbconnect.php';


// Open the CSV file for writing
$fp = fopen('./reports/allOrders.csv', 'w');

$stmtColumns = $con->prepare("DESCRIBE VW_ORDERHISTORY" );
$stmtColumns->execute();
$columns = $stmtColumns->fetchAll(PDO::FETCH_COLUMN);

// Write table name as a comment in the CSV file
fputcsv($fp, ["ORDER HISTORY"]);

// Write column names to the CSV file
fputcsv($fp, $columns);

// Fetch data from the current table
$stmtData = $con->prepare("SELECT * FROM VW_ORDERHISTORY");
$stmtData->execute();
$data = $stmtData->fetchAll(PDO::FETCH_ASSOC);

// Write data to the CSV file
foreach ($data as $row) {
    fputcsv($fp, $row);
}


// Close the CSV file
fclose($fp);

// Download the CSV file
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename=' . basename('./reports/allOrders.csv'));
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize('./reports/allOrders.csv'));
readfile('./reports/allOrders.csv');
?>