<?php
 $servername = "localhost";
 $usernaeme = "root";
$password = "";
$database = "leads_db";

//Create connection
 $connection = new mysqli($servername, $usernaeme, $password, $database);

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





if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $firstName= $_POST["firstName"];
$lastName = $_POST["lastName"];
$email = $_POST["email"];
$phoneNumber = $_POST["phone"];
$ip = $_POST["ip"];
$country = $_POST["country"];
$url = $_POST["url"];
$note = $_POST["note"];
$sub_1 = $_POST["sub_1"];
$called = $_POST["called"];
$created_at = $_POST["created_at"];

do{
    if(empty($firstName) || empty($lasttName) || empty($email) || empty($phoneNumber) || empty($ip) || empty($country) || empty($url) || empty($note) || empty($sub_1) || empty($called) || empty($created_at)){
        $errorMessage = "All the fields are required";
        break;
    }

    //Add new client to the database
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

$successMessage = "Cliend added correctly";
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
            <input type="text" class="form-control" name="firstName" value="<?php echo $firstName; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Last Name</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="lastName" value="<?php echo $lastName; ?>">
        </div>
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Email</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
        </div>
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Phone Number</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="phone" value="<?php echo $phoneNumber; ?>">
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
            <input type="number" min="0" max="1" class="form-control" name="called" value="<?php echo $called; ?>">
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
    <strong>$succesMessage</strong>
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
            <a class="btn btn-outline-primary" href="/intername/backOffice/index.php" role="button">Cancel</a>
        </div>
    </div>
</form>



</div>


</body>
</html>