<?php

// Start session
session_start();
	// Include database connection code
	require_once 'includes/db.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

	// Fetch candy item from database
	$stmt = $db->prepare('SELECT * FROM users WHERE username = ?');
	$stmt->execute(array($username));
	$stmt->bind_result($id, $username, $email, $pass_hash, $role);
	if ($stmt->fetch() > 0) {
		if (password_verify($password, $pass_hash)) {
            // Login successful
            $_SESSION["user_id"] = $id;
            $_SESSION["username"] = $username;
            $_SESSION["email"] = $email;
            $_SESSION["role"] = $role;
            header("Location: candy.php");
            exit;
        } else {
            // Incorrect password
            $error = "Incorrect password";
        }
	} else {
  // Username not found
  $error = "Username not found";
	}
}
?>
<?php require_once 'includes/header.php'; ?>


<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron" style="background:url('images/banner10.jpg');background-size:cover;opacity:.6;">
  <div class="container">
	<h1 class="display-3">Hello, Candy Plush Lovers!</h1>
	<p>Here you can create an account and log in to manage the inventory of the store.</p>
	<p><a class="btn btn-primary btn-lg" href="register.php" role="button">Create an Account &raquo;</a></p>
  </div>
</div>



<div class="container">

<div class="row">
<div class="col-6">

	<h1>Log In</h1>

<?php if(isset($error)): ?>
<div class="alert alert-danger" role="alert">
<p><?php echo $error; ?></p>
</div>
<?php endif; ?>

<p>Log in to your account with your username and password.</p>

		<form class="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<div class="mb-3 ">
			<label class="form-label" for="username">User Name:</label>
			<input class="form-control" type="text" name="username" autofocus required>
</div><div class="mb-3 ">
			<label class="form-label" for="password">Password:</label>
			<input class="form-control" type="password" name="password" required>
			</div><div class="mb-3 ">
			<input class="btn btn-primary" type="submit" value="Log In">
</div>
		</form>

		</div><div class="col-6">

			<img class="img" src="images/pinkplush.jpg"/>

		</div>
		</div>

		<?php require_once 'includes/footer.php'; ?>
