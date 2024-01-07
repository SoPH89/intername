<?php

// URL of the JSON resource
$jsonUrl = "https://jsonplaceholder.typicode.com/users";

// Initialize cURL session
$ch = curl_init($jsonUrl);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute cURL session and get the JSON response
$jsonResponse = curl_exec($ch);

// Close cURL session
curl_close($ch);

// Check if the request was successful
if ($jsonResponse === false) {
    die('Error occurred while fetching JSON data');
}

// Decode the JSON response
$users = json_decode($jsonResponse, true);

// Check if decoding was successful
if ($users === null) {
    die('Error occurred while decoding JSON data');
}

// Create a database connection
$conn = new mysqli('localhost', 'root', '', 'leads_db');

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Iterate through the users and insert into the database
foreach ($users as $user) {
    $email = $user['email'];

    // Check if the email already exists in the database
    $existingEmailCheck = "SELECT COUNT(*) as count FROM leads WHERE email = '$email'";
    $resultEmailCheck = $conn->query($existingEmailCheck);
    $count = $resultEmailCheck->fetch_assoc()['count'];

    // If the email doesn't exist, insert into the database
    if ($count == 0) {
        $firstName = $user['name']; // Assuming 'name' corresponds to first_name in your database
        $lastName = ""; // You may not have a last_name field in the provided JSON data
        $phoneNumber = $user['phone'];
        $ip = $user['address']['geo']['lat'] . "," . $user['address']['geo']['lng'];
        $country = $user['address']['city']; // Assuming 'city' corresponds to country in your database
        $url = $user['website'];
        $note = ""; // You may not have a note field in the provided JSON data
        $sub1 = ""; // You may not have a sub_1 field in the provided JSON data
        $called = ""; // You may not have a called field in the provided JSON data
        $createdAt = date("Y-m-d H:i:s"); // Current timestamp

        // Insert data into the database (replace with your actual table and field names)
        $sql = "INSERT INTO leads (first_name, last_name, email, phone_number, ip, country, url, note, sub_1, called, created_at) VALUES ('$firstName', '$lastName', '$email', '$phoneNumber', '$ip', '$country', '$url', '$note', '$sub1', '$called', '$createdAt')";
        $result = $conn->query($sql);

        // Check if the insertion was successful
        if (!$result) {
            echo "Error inserting data for user with email $email: " . $conn->error . "<br>";
        }
    } else {
        echo "Skipped entry with email $email as it already exists in the database.<br>";
    }
}
echo "JSON resource has been added into the database successfully.";
// Close the database connection
$conn->close();

?>
