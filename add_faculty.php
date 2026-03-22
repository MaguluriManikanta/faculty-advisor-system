<?php
include 'db.php';

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $department = $_POST['department'];
    $subject = $_POST['subject'];

    $sql = "INSERT INTO faculty (name,email,phone,department,subject)
            VALUES ('$name','$email','$phone','$department','$subject')";

    if($conn->query($sql)){
        echo "Faculty Added Successfully";
    } else {
        echo "Error" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Faculty</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
<div class="card p-4 shadow">

<h2>Add Faculty</h2>

<form method="POST">
<input class="form-control mb-2" name="name" placeholder="Name" required>
<input class="form-control mb-2" name="email" placeholder="Email" required>
<input class="form-control mb-2" name="phone" placeholder="Phone" required>
<input class="form-control mb-2" name="department" placeholder="Department">
<input class="form-control mb-2" name="subject" placeholder="Subject">
<button class="btn btn-primary w-100" name="submit">Add Faculty</button>
</form>

</div>
</div>

</body>
</html>
