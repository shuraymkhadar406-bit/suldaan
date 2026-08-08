<!DOCTYPE html>
<html>
<head>
    <title>Contact Us</title>
    <link rel="stylesheet" href="css/contact.css">
</head>
<body>

<h2>Contact Us Please</h2>

<form action="php/contact-process.php" method="POST">

    <label>Full Name</label><br>
    <input type="text" name="full_name" required><br><br>

    <label>Email</label><br>
    <input type="email" name="email" required><br><br>

    <label>Subject</label><br>
    <input type="text" name="subject" required><br><br>

    <label>Message</label><br>
    <textarea name="message" rows="6" cols="40" required></textarea><br><br>

    <button type="submit">Send Message</button>

</form>

</body>
</html>