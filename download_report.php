<?php
session_start();
include "db_conn.php";

// Total downloads
$total = $conn->query("SELECT COUNT(*) FROM downloads")->fetchColumn();

// Today's downloads
$today = $conn->query("
SELECT COUNT(*) FROM downloads
WHERE DATE(downloaded_date)=CURDATE()
")->fetchColumn();

// Monthly downloads
$month = $conn->query("
SELECT COUNT(*) FROM downloads
WHERE MONTH(downloaded_date)=MONTH(CURDATE())
AND YEAR(download_date)=YEAR(CURDATE())
")->fetchColumn();

// Yearly downloads
$year = $conn->query("
SELECT COUNT(*) FROM downloads
WHERE YEAR(downloaded_date)=YEAR(CURDATE())
")->fetchColumn();

// Download history
$stmt = $conn->query("
SELECT *
FROM downloads
ORDER BY downloaded_date DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Download Reports</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#f5f7fb;
}
.card{
    border:none;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,.1);
}
table{
    background:white;
}
</style>

</head>

<body>

<div class="container mt-4">

<h2 class="mb-4 text-center">
Download Reports
</h2>

<div class="row">

<div class="col-md-3">
<div class="card p-3 text-center">
<h5>Total Downloads</h5>
<h2><?= $total ?></h2>
</div>
</div>

<div class="col-md-3">
<div class="card p-3 text-center">
<h5>Today</h5>
<h2><?= $today ?></h2>
</div>
</div>

<div class="col-md-3">
<div class="card p-3 text-center">
<h5>This Month</h5>
<h2><?= $month ?></h2>
</div>
</div>

<div class="col-md-3">
<div class="card p-3 text-center">
<h5>This Year</h5>
<h2><?= $year ?></h2>
</div>
</div>

</div>

<hr>

<h3 class="mb-3">
Download History
</h3>

<table class="table table-bordered table-striped">

<thead class="table-dark">

<tr>
<th>ID</th>
<th>User ID</th>
<th>Book</th>
<th>File</th>
<th>Date</th>
</tr>

</thead>

<tbody>

<?php while($row=$stmt->fetch(PDO::FETCH_ASSOC)){ ?>

<tr>

<td><?= $row['id']; ?></td>

<td><?= $row['user_id']; ?></td>

<td><?= $row['book_title']; ?></td>

<td><?= $row['book_file']; ?></td>

<td><?= $row['downloaded_date']; ?></td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</body>

</html>