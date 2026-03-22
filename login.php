<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    if ($user['role'] == 'faculty') {
        header("Location: faculty_dashboard.php?id=".$user['id']);
    } else {
        header("Location: student_dashboard.php?id=".$user['id']);
    }
} else {
    echo "Invalid Login";
}
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
<div class="card p-4 shadow">

<h2>Login</h2>

<form method="POST">
<input class="form-control mb-2" name="email" placeholder="Email">
<input class="form-control mb-2" type="password" name="password" placeholder="Password">
<button class="btn btn-success w-100">Login</button>
</form>

</div>
</div>

</body>
</html>