<?php
include 'db.php';
$faculty_id = $_GET['id'];

// Handle search
$search_query = "";
if(isset($_GET['search']) && $_GET['search'] != ""){
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $search_query = " AND (students.name LIKE '%$search%' 
                          OR students.email LIKE '%$search%' 
                          OR students.class LIKE '%$search%')";
}

// Fetch students assigned to this faculty
$sql = "SELECT students.* FROM students 
        JOIN advisor ON students.id = advisor.student_id 
        WHERE advisor.faculty_id='$faculty_id' $search_query";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>Faculty Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container mt-4">

<div class="d-flex justify-content-between align-items-center">
    <h2 class="text-primary">Faculty Dashboard</h2>
    <a href="logout.php" class="btn btn-danger">Logout</a>
</div>
<!-- Buttons -->
<div class="mt-3 mb-3 text-center">
    <a href="add_faculty.php" class="btn btn-info">Add Faculty</a>
    <a href="add_subject.php" class="btn btn-success">Add Subject</a>
    <a href="assign_advisor.php" class="btn btn-warning">Assign Advisor</a>
</div>

<!-- Search Students -->
<div class="card p-3 mt-3">
<h4>Search Students</h4>
<form method="GET" class="d-flex gap-2">
    <input type="hidden" name="id" value="<?php echo $faculty_id; ?>">
    <input class="form-control" type="text" name="search" placeholder="Search by Name, Email or Class">
    <button class="btn btn-primary">Search</button>
</form>
</div>

<!-- Your Students List -->
<div class="card p-3 mt-3">
<h4>Your Students</h4>
<?php
if($result->num_rows > 0){
    while($r = $result->fetch_assoc()){
        echo $r['name'] . " (" . $r['class'] . ") ";
        echo "<a href='view_student.php?id=".$r['id']."' class='btn btn-sm btn-info'>View Details</a><br>";
    }
} else {
    echo "No students found.";
}
?>
</div>

<!-- Add Grade Form -->
<div class="card p-3 mt-3">
<h4>Add Grade</h4>
<form action="add_grade.php" method="POST">
<input type="hidden" name="faculty_id" value="<?php echo $faculty_id; ?>">
<input class="form-control mb-2" name="student_id" placeholder="Student ID" required>
<input class="form-control mb-2" name="subject_id" placeholder="Subject ID" required>
<input class="form-control mb-2" name="grade" placeholder="Grade" required>
<button class="btn btn-primary w-100">Add Grade</button>
</form>
</div>

<!-- Book Meeting Form -->
<div class="card p-3 mt-3">
<h4>Book Meeting</h4>
<form action="book_meeting.php" method="POST">
<input type="hidden" name="faculty_id" value="<?php echo $faculty_id; ?>">
<input class="form-control mb-2" name="student_id" placeholder="Student ID" required>
<input class="form-control mb-2" type="date" name="date" required>
<input class="form-control mb-2" name="message" placeholder="Meeting Message" required>
<button class="btn btn-warning w-100">Book Meeting</button>
</form>
</div>

</div>

</body>
</html>
