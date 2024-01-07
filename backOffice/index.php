<?php

$page = 'index';
session_start();

// Set your desired password
$correctPassword = "1234";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the entered password is correct
    if ($_POST["password"] === $correctPassword) {
        // Store the authentication status in the session
        $_SESSION["authenticated"] = true;
    } else {
        $error_message = "Invalid password. Try again.";
    }
}

// If the user is authenticated or not submitted, display the table
if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] || !isset($_POST["password"])) {
    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap/min.css"> 
    <title>Back Office</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="margin: 50px;">

<?php if($page == 'index'): ?>
    <script language="Javascript">
            //prompt.
            var password;
            var correctPass = "intername"; 
            password = prompt("Enter in the password:","");

            if(password == correctPass) {
                    alert('click OK to view this site');
            } else {
                    window.location = "http://google.com"
            } 
            //->
    </script>               
<?php endif; ?>
    <div class="container my-5"></div>
    <h1>List of leads</h1>
    <a class="btn btn-primary" href="http://localhost/intername/backoffice/create.php" role="button">New Client</a>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>IP</th>
                <th>Country</th>
                <th>URL</th>
                <th>Note</th>
                <th>sub_1</th>
                <th>Called</th>
                <th>Created At</th>
            </tr>
        </thead>

        <tbody>
            <?php

            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "leads_db";

            //Create connection
            $connection = new mysqli($servername, $username, $password, $database);

            //Check connection
            if($connection->connect_error){
                die("Connection failed: " . $connection->connect_error);
            }

            //Read database from table
            $sql = "SELECT * FROM  leads";
            $result = $connection->query($sql);

            if(!$result){
                die("Invalid query: " . $connection->error);
            }

            while($row = $result->fetch_assoc()){
                echo  "<tr>
                <td>$row[id]</td>
                <td>$row[first_name]</td>
                <td>$row[last_name]</td>
                <td>$row[email]</td>
                <td>$row[phone_number]</td>
                <td>$row[ip]</td>
                <td>$row[country]</td>
                <td>$row[url]</td>
                <td>$row[note]</td>
                <td>$row[sub_1]</td>
                <td>$row[called]</td>
                <td>$row[created_at]</td>
                <td>
                    <a href='http://localhost/intername/backoffice/edit.php?id=$row[id]'>Edit</a>
                    <a href='delete'>Delete</a>
                </td>
            </tr>";
            }
        }
                


          
            ?>
        </tbody>
    </table>
</body>
</html>