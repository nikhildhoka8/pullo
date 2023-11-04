<?php
// Database connection settings
require_once 'dbconnect.php';

// CSV file name
$csvFileName = 'data.csv';

// Read the CSV file
if (($handle = fopen($csvFileName, "r")) !== false) {
    // Skip the first row (header)
    fgetcsv($handle, 1000, ",");

    while (($data = fgetcsv($handle, 1000, ",")) !== false) {
        $userTypeId = $data[0];
        $firstName = $data[1];
        $lastName = $data[2];
        $phoneNumber = $data[3];
        $email = $data[4];
        $password = $data[5];
        $dateOfBirth = $data[6];

        // Insert data into the SQL database
        $insertQuery = "INSERT INTO USER_TABLE (userTypeId, fName, lName, phoneNumber, email, password, dateOfBirth) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($insertQuery);
        $stmt->execute([$userTypeId, $firstName, $lastName, $phoneNumber, $email, $password, $dateOfBirth]);
    }
    fclose($handle);
}

echo "Data imported successfully.";

// Close the database connection
?>
