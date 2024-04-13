<!DOCTYPE html>
<html>
<head>
	<title>Forgot Password</title>
</head>
<body>
	<h1>Forgot Password</h1>
	<form action="forgot.php" method="post">
		<label for="email">Email:</label><br>
		<input type="email" name="email" id="email" required><br>
		<button type="submit">Submit</button>
	</form>
</body>
</html>

<?php

// forgot_action.php

require 'db.php';

$email = $_POST['email'];

// Check if the email exists in the database
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) == 1) {
	$user = mysqli_fetch_assoc($result);
	$token = bin2hex(random_bytes(50));
	$expiry = time() + 3600; // expiry time is 1 hour

	// Save the token and expiry time to the database
	$sql = "UPDATE users SET token = '$token', token_expiry = '$expiry' WHERE id = {$user['id']}";
	mysqli_query($conn, $sql);

	// Send the password reset link to the user's email
	$url = "http://yourwebsite.com/reset_password.php?token=$token";
	$to = $user['email'];
	$subject = "Password Reset Request";
	$message = "Click this link to reset your password: $url";
	$headers = "From: yourname@yourwebsite.com";
	mail($to, $subject, $message, $headers);

	echo "A password reset link has been sent to your email.";
} else {
	echo "Email not found.";
}

mysqli_close($conn);

?>