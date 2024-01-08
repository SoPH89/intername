<?php

$page = 'index';
session_start();

// Set your desired password
$correctPassword = "intername";

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
                     <?php $_SESSION["password_entered"] = true; ?>
                } else {
                    window.location = "http://google.com";
                } 
                //-->
            </script>               
        <?php endif; ?>
        <div class="container my-5"></div>
        <h1>List of leads</h1>
        <a class="btn btn-primary" href="http://localhost/intername/backoffice/create.php" role="button">New Client</a>
        <br><br>
        <?php
        $selected_status = isset($_GET['status']) ? $_GET['status'] : '';
        $selected_country = isset($_GET['country']) ? $_GET['country'] : '';
        $selected_date = isset($_GET['date']) ? $_GET['date'] : '';
        ?>
        <form class="form-control" method="get">
            <label for="status">Status:</label>
            <select name="status" id="status">
                <option value="">-Select-</option>
                <option value="1" <?= ($selected_status == '1') ? 'selected' : ''; ?>>Called</option>
            </select>

            <label for="country">Country:</label>
            <select name="country" id="country">
                <option value="">-Select-</option>
                <option value="USA" <?= ($selected_country == 'USA') ? 'selected' : ''; ?>>USA</option>
                <option value="Gwenborough" <?= ($selected_country == 'Gwenborough') ? 'selected' : ''; ?>>Gwenborough</option>
                <option value="Wisokyburgh" <?= ($selected_country == 'Wisokyburgh') ? 'selected' : ''; ?>>Wisokyburgh</option>
                <option value="McKenziehaven" <?= ($selected_country == 'McKenziehaven') ? 'selected' : ''; ?>>McKenziehaven</option>
                <option value="South Elvis" <?= ($selected_country == 'South Elvis') ? 'selected' : ''; ?>>South Elvis</option>
                <option value="Roscoeview" <?= ($selected_country == 'Roscoeview') ? 'selected' : ''; ?>>Roscoeview</option>
                <option value="South Christy" <?= ($selected_country == 'South Christy') ? 'selected' : ''; ?>>South Christy</option>
                <option value="Howemouth" <?= ($selected_country == 'Howemouth') ? 'selected' : ''; ?>>Howemouth</option>
                <option value="Aliyaview" <?= ($selected_country == 'Aliyaview') ? 'selected' : ''; ?>>Aliyaview</option>
                <option value="Bartholomebury" <?= ($selected_country == 'Bartholomebury') ? 'selected' : ''; ?>>Bartholomebury</option>
                <option value="Lebsackbury" <?= ($selected_country == 'Lebsackbury') ? 'selected' : ''; ?>>Lebsackbury</option>
                <option value="Isreal" <?= ($selected_country == 'Isreal') ? 'selected' : ''; ?>>Isreal</option>
            </select>

            <label for="date">Select Date:</label>
            <input type="date" name="date" id="date" value="<?= $selected_date; ?>">

            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
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
                    <th>Action</th>
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

                // Build the SQL query based on filters
                $sql = "SELECT * FROM leads";

                if (isset($_GET['status'])) {
                    $date = $connection->real_escape_string($_GET['status']);
                    $sql .= ($_GET['status'] == '1') ? " WHERE called = 1": " WHERE called = 0";
                }
                
                if (isset($_GET['date']) && !empty($_GET['date'])) {
                    $date = $connection->real_escape_string($_GET['date']);
                    $sql .= " AND created_at LIKE '$date%'";
                }

                if(isset($_GET['country']) && !empty($_GET['country'])) {
                    $country = $connection->real_escape_string($_GET['country']);
                    $sql .= " AND country = '".$country."'";
                }

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

            ?>
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
}