<?php
session_start();
include_once 'dbconnect.php';

// Get the list of tables in the database
$stmtTables = $con->prepare("SELECT table_name FROM information_schema.tables WHERE table_schema = 'ndhoka_db' AND table_type = 'BASE TABLE';");
$stmtTables->execute();
$tables = $stmtTables->fetchAll(PDO::FETCH_ASSOC);

// Open the CSV file for writing
$fp = fopen('./reports/allData.csv', 'w');

// Loop through each table
foreach ($tables as $table) {
    // Get the columns of the current table
    $stmtColumns = $con->prepare("DESCRIBE " . $table['TABLE_NAME']);
    $stmtColumns->execute();
    $columns = $stmtColumns->fetchAll(PDO::FETCH_COLUMN);

    // Write table name as a comment in the CSV file
    fputcsv($fp, ["# Table: " . $table['TABLE_NAME']]);

    // Write column names to the CSV file
    fputcsv($fp, $columns);

    // Fetch data from the current table
    $stmtData = $con->prepare("SELECT * FROM " . $table['TABLE_NAME']);
    $stmtData->execute();
    $data = $stmtData->fetchAll(PDO::FETCH_ASSOC);

    // Write data to the CSV file
    foreach ($data as $row) {
        fputcsv($fp, $row);
    }

    // Add an empty line between tables for better readability
    fputcsv($fp, []);
}

// Close the CSV file
fclose($fp);

// Download the CSV file
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename=' . basename('./reports/allData.csv'));
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize('./reports/allData.csv'));
readfile('./reports/allData.csv');
?>
