<?php
 $servername = "localhost";
 $username = "root";
$password = "";
$database = "leads_db";

//Create connection
 $connection = new mysqli($servername, $username, $password, $database);

$id = "";
$firstName= "";
$lastName = "";
$email = "";
$phoneNumber = "";
$ip = "";
$country = "";
$url = "";
$note = "";
$sub_1 = "";
$called = "";
$created_at = "";

$errorMessage = "";
$successMessage = "";


if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(!isset($_GET["id"])){
        header("location: http://localhost/intername/backOffice/index.php");

        exit;
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM leads WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if(!$row){
        header("location: http://localhost/intername/backOffice/index.php");

        exit;
    }

    $firstName = $row["first_name"];
    $lastName = $row["last_name"];
    $email = $row["email"];
    $phoneNumber = $row["phone_number"];
    $ip = $row["ip"];
    $country = $row["country"];
    $url = $row["url"];
    $note = $row["note"];
    $sub_1 = $row["sub_1"];
    $called = $row["called"];
    $created_at = $row["created_at"];
    }
    else{
    $id = $_POST["id"];
    $firstName = $_POST["first_name"];
    $lastName = $_POST["last_name"];
    $email = $_POST["email"];
    $phoneNumber = $_POST["phone_number"];
    $ip = $_POST["ip"];
    $country = $_POST["country"];
    $url = $_POST["url"];
    $note = $_POST["note"];
    $sub_1 = $_POST["sub_1"];
    $called = $_POST["called"];
    $created_at = $_POST["created_at"];
    
    do{
            if(empty($id) || empty($firstName) || empty($lastName) || empty($email) || empty($phoneNumber) || empty($ip) || empty($country) || empty($url) || empty($note) || empty($sub_1)  || empty($created_at)){
        $errorMessage = "All the fields are required";
        break;
    }

    $sql= "UPDATE leads " .
        "SET first_name='$firstName', last_name='$lastName', email='$email', phone_number='$phoneNumber', ip='$ip', country='$country', url='$url', note='$note', sub_1='$sub_1', called='$called', created_at='$created_at' " . 
        "WHERE id=$id";  

        $result = $connection->query($sql);

        if(!$result){
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $successMessage = "Client updated correctly";

        header("location: http://localhost/intername/backOffice/index.php");
        exit;
    } while(false);
}

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
<body>
<div class="container my-5"> 
<h2>New Lead</h2>

<?php
if(!empty($errorMessage)){
    echo "
    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
    <strong>$errorMessage</strong>
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>
    ";
}
?>

<form method="post">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">First Name</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="first_name" value="<?php echo $firstName; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Last Name</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="last_name" value="<?php echo $lastName; ?>">
        </div>
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Email</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
        </div>
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Phone Number</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="phone_number" value="<?php echo $phoneNumber; ?>">
        </div>
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">IP</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="ip" value="<?php echo $ip; ?>">
        </div>
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Country</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="country" value="<?php echo $country; ?>">
        </div>
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">URL</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="url" value="<?php echo $url; ?>">
        </div>
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Note</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="note" value="<?php echo $note; ?>">
        </div>
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">sub_1</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="sub_1" value="<?php echo $sub_1; ?>">
        </div>
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Called</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="called" min="0" max="1" value="<?php echo $called; ?>">
        </div>
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Created_at</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="created_at" value="<?php echo $created_at; ?>">
        </div>
    </div>

    <?php
    if(!empty($successMessage)){
        echo "
    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
    <strong>$successMessage</strong>
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>
    ";
    }
    ?>
    <div class="row mb-3">
        <div class="offset-sm-3 col-sm-3 d-grid">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        <div class="col-sm-3 d-grid">
            <a class="btn btn-outline-primary" href="http://localhost/intername/backOffice/index.php" role="button">Cancel</a>
        </div>
    </div>
</form>



</div>


</body>
</html>