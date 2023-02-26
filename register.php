<?php
	// Include database connection code
	require_once 'includes/db.php';

// Function to sanitize data
function cleanData($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$username = cleanData($_POST['username']);
    $email = cleanData($_POST['email']);
    $password = cleanData($_POST['password']);
    $role = cleanData($_POST['role']);

 // Hash password
 $password = password_hash($password, PASSWORD_DEFAULT);

   // Check if email already exists
   $stmt = $db->prepare('SELECT * FROM users WHERE email = ? OR username = ?');
   $stmt->execute(array($email, $username));
   if ($stmt->fetch() > 0) {
	   $error = "Email or UserName already exists!";
   } else {
	$stmt = $db->prepare('INSERT INTO users (username, email, password,role) VALUES (?,?,?,?)');
	$stmt->execute(array($username, $email, $password, $role));
		if ($stmt) {
			$alert = "Registration successful <a href=login.php>Log in</a>";
		} else {
			$error =  "Error: " . mysqli_error($db);
		}

	}
}

?><?php require_once 'includes/header.php'; ?>

<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron" style="background:url('images/banner6.jpg');background-size:cover;">
  <div class="container">
	<h1 class="display-3">Create Your Account</h1>
	
  </div>
</div>

	<div class="container">

<div class="row">
<div class="col-6">

<h1>Register</h1>


<?php if(isset($alert)): ?>
<div class="alert alert-primary" role="alert">
<p><?php echo $alert; ?></p>
</div>
<?php endif; ?>

<?php if(isset($error)): ?>
<div class="alert alert-danger" role="alert">
<p><?php echo $error; ?></p>
</div>
<?php endif; ?>

<p>
			Create a username and password and register an account to manage the candy plush list.</p>

		<form class="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<div class="mb-3 ">
			<label class="form-label" for="username">User Name:</label>
			<input class="form-control" type="text" name="username" autofocus required>
</div><div class="mb-3 ">
<label class="form-label" for="email">Email:</label>
			<input class="form-control" type="email" name="email" required>
			</div><div class="mb-3 ">
			<label class="form-label" for="password">Password:</label>
			<input class="form-control" type="password" name="password" required>
			</div>
			<div class="mb-3 ">
			<label class="form-label" for="role">Choose a role:</label>

<select class="form-control" name="role" id="role">
  <option value="customer">CUSTOMER</option>
  <option value="admin">ADMIN</option>
</select>	</div>
			<div class="mb-3 ">
			<input class="btn btn-primary" type="submit" value="Register">

</div>
		</form>
		<p>
			Already have an account? <a href="login.php">Log in</a></p>

		</div><div class="col-6">

			<img class="img" src="images/avo.png"/>

		</div>
		</div>
		<?php require_once 'includes/footer.php'; ?>
