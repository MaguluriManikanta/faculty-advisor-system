<?php
include 'db.php';
$id = $_GET['id'];

$student = $conn->query("SELECT * FROM students WHERE id='$id'")->fetch_assoc();
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">

<div class="d-flex justify-content-between align-items-center">
    <h2 class="text-primary">Student Dashboard</h2>
    <a href="logout.php" class="btn btn-danger">Logout</a>
</div>

<div class="card p-3 mt-3">
<h4>Profile</h4>
Name: <?php echo $student['name']; ?><br>
Email: <?php echo $student['email']; ?><br>
GPA: <?php echo $student['gpa']; ?><br>
</div>

<div class="card p-3 mt-3">
<h4>Faculty</h4>
<?php
$res = $conn->query("SELECT faculty.name FROM faculty 
JOIN advisor ON faculty.id = advisor.faculty_id 
WHERE advisor.student_id='$id'");
$row = $res->fetch_assoc();
echo $row['name'];
?>
</div>

<div class="card p-3 mt-3">
<h4>Grades</h4>
<?php
$sql = "SELECT subjects.subject_name, grades.grade 
FROM grades JOIN subjects 
ON grades.subject_id = subjects.id 
WHERE grades.student_id='$id'";

$res = $conn->query($sql);
while($r=$res->fetch_assoc()){
echo $r['subject_name']." - ".$r['grade']."<br>";
}
?>
</div>

<div class="card p-3 mt-3">
<h4>Notifications</h4>
<?php
$res=$conn->query("SELECT * FROM notifications WHERE user_id='$id'");
while($r=$res->fetch_assoc()){
echo $r['message']."<br>";
}
?>
</div>

<div class="card p-3 mt-3">
<h4>Meetings</h4>
<?php
$res=$conn->query("SELECT * FROM meetings WHERE student_id='$id'");
while($r=$res->fetch_assoc()){
echo $r['date']." - ".$r['message']."<br>";
}
?>
</div>

</div>