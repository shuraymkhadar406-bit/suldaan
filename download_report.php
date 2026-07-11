<?php
session_start();
include "db_conn.php";

/* optional security */
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$sql = "SELECT downloads.*, users.full_name 
        FROM downloads 
        LEFT JOIN users ON users.id = downloads.user_id
        ORDER BY downloads.downloaded_at DESC";

$stmt = $conn->prepare($sql);
$stmt->execute();
$downloads = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Download Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/report.css">
</head>
<body>

<div class="report-container">

    <div class="report-header">
        <h2>📥 Download Report</h2>
        <p>Online Digital Library & E-Book Store</p>
    </div>

    <table class="table report-table">

        <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Book Title</th>
                <th>Book File</th>
                <th>Downloaded At</th>
            </tr>
        </thead>

        <tbody>

        <?php
        $i=1;
        foreach($downloads as $d){
        ?>

        <tr>
            <td><?= $i++ ?></td>
            <td><?= htmlspecialchars($d['full_name']) ?></td>
            <td><?= htmlspecialchars($d['book_title']) ?></td>
            <td><?= htmlspecialchars($d['book_file']) ?></td>
            <td><?= $d['downloaded_at'] ?></td>
        </tr>

        <?php } ?>

        </tbody>

    </table>

</div>

</body>
</html>