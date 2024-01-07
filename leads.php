<?php
// Database connection code
$conn = mysqli_connect('localhost', 'root', '', 'leads_db');

// Checking Connection
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

// Get the post records
$first_name = $_REQUEST['first_name'] ?? '';
$last_name = $_REQUEST['last_name'] ?? '';
$email = $_REQUEST['email'] ?? '';
$phone = $_REQUEST['phone'] ?? '';
$note = $_REQUEST['note'] ?? '';
$sub_1 = $_REQUEST['sub_1'] ?? '';

// Function to get user's IP address
function get_IP_address()
{
    foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP',
                   'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
        if (array_key_exists($key, $_SERVER) === true) {
            foreach (explode(',', $_SERVER[$key]) as $IPaddress) {
                $IPaddress = trim($IPaddress); // Just to be safe

                if (filter_var($IPaddress, FILTER_VALIDATE_IP,
                        FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                    return $IPaddress;
                }
            }
        }
    }
    return ''; // Return a default value if no valid IP found
}

$ip = get_IP_address();

// Get location information based on IP
$loc = file_get_contents("http://ip-api.com/json/$ip");
$loc_decoded = json_decode($loc);
$loc_country = $loc_decoded->country ?? '';
$loc_ip = $loc_decoded->query ?? '';

// Getting the URL
$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https://" : "http://";
$url .= $_SERVER['HTTP_HOST'];
$url .= $_SERVER['REQUEST_URI'];

// Check if email exists in the leads table
$query = mysqli_query($conn, "SELECT * FROM `leads` WHERE email = '$email'");
if (!$query) {
    die("Error: " . mysqli_error($conn));
}

if (mysqli_num_rows($query) > 0) {
    // Redirect to contact.html with parameter ?lead=succeed
    header("Location: contact.html?lead=email_exists");
    exit();
} else {
    // Inserting leads
    $stmt = $conn->prepare("INSERT INTO leads 
                            (first_name, last_name, email, phone_number, ip, country, url, note, sub_1, called, created_at) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, '', NOW())");

    // Bind parameters to the statement
    $stmt->bind_param("sssssssss", $first_name, $last_name, $email, $phone, $loc_ip, $loc_country, $url, $note, $sub_1);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to contact.html with parameter ?lead=succeed
        header("Location: contact.html?lead=succeed&name=".$first_name." ".$last_name."");
        exit();
    } else {
        die("Error: " . $stmt->error);
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
