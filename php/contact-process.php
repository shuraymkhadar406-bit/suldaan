<?php
include "../db_conn.php";

if(isset($_POST['full_name'])){

    $name = $_POST['full_name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $sql = "INSERT INTO contact(full_name,email,subject,message)
            VALUES(?,?,?,?)";

    $stmt = $conn->prepare($sql);
    $stmt->execute([$name,$email,$subject,$message]);

    header("Location: ../contact.php?success=Message sent successfully");
    exit();
}
?>