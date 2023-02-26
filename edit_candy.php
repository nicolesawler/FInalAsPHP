<?php
	session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
	// If user is not logged in, redirect to login page
	if (!isset($_SESSION['user_id'])) {
		header('Location: login.php');
		exit();
	}
	// Check if user is admin
if (!isset($_SESSION["role"]) || $_SESSION["role"] != 'admin') {
    header("Location: candy.php");
    exit;
}
	// Include database connection code
	require_once 'includes/db.php';


	// Get candy item ID from URL parameter
	if(isset($_GET['id'])){
		$id = $_GET['id'];

			// Fetch candy item from database
			$stmt = $db->prepare('SELECT * FROM candy WHERE id = ?');
			$stmt->execute(array($id));
			$stmt->bind_result($id, $name, $desc, $price, $quantity, $image, $date, $cat);
			$stmt->fetch();

	} else if($_SERVER['REQUEST_METHOD'] == 'POST'){

		$id = $_POST['id'];
		$name = $_POST['name'];
		$desc = $_POST['description'];
		$price = $_POST['price'];
		$quantity = $_POST['quantity'];
		$cat = $_POST['cat'];

		//echo $quantity;
		// Update candy item in database
		$stmt = $db->prepare('UPDATE candy SET name = ?, description = ?, price = ?, quantity = ?, category = ? WHERE id = ?');
		$stmt->execute(array($name, $desc, $price, $quantity, $cat, $id));
		
			// Fetch candy item from database
			$stmt = $db->prepare('SELECT * FROM candy WHERE id = ?');
			$stmt->execute(array($id));
			$stmt->bind_result($id, $name, $desc, $price, $quantity, $image, $date, $cat);
			$stmt->fetch();

			$alert = "Item has been updated!";
	}else{
			// Redirect back to candy page
			header('Location: index.php');
			exit();
	}
	
?>
<?php require_once 'includes/header.php'; ?>


<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron" style="background:url('images/banner8.png');background-size:cover;opacity:.6;">
  <div class="container">
  <h1 class="display-3">Hello, <?php echo $_SESSION["username"]; ?>!</h1>
	<p>You are currently updating a  candy plush in the inventory list.</p>
	<p><a class="btn btn-primary btn-lg" href="index.php" role="button">Manage Stock &raquo;</a></p>
  </div>
</div>



	<div class="container">

    <h1>Edit Candy Plushes</h1>

	<?php if(isset($alert)): ?>
<div class="alert alert-primary" role="alert">
<p><?php echo $alert; ?></p>
</div>
<?php endif; ?>


		<form class="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<div class="mb-3 "><input class="form-control" type="number" name="id" value="<?php echo $id; ?>" hidden>
			<label class="form-label" for="name">Name:</label>
			<input class="form-control" type="text" name="name" value="<?php echo $name; ?>" required>
			</div><div class="mb-3 ">
				<label class="form-label" for="description">Description:</label>
			<textarea class="form-control" name="description" required><?php echo $desc; ?></textarea>
			</div><div class="mb-3 ">
				<label class="form-label" for="price">Price:</label>
			<input class="form-control" type="number" name="price" step="0.01" value="<?php echo $price; ?>" required>
			</div><div class="mb-3 ">
				<label class="form-label" for="quantity">Quantity:</label>
			<input class="form-control" type="number" name="quantity" step="1" value="<?php echo $quantity; ?>" required>
			</div>
			<div class="mb-3 ">
			<label class="form-label" for="role">Category:</label>

<select class="form-control" name="cat" id="cat">
  <option selected value="<?php echo $cat; ?>"><?php echo strtoupper($cat); ?></option>
  <option value="plush">PLUSH</option>
  <option value="candy">CANDY</option>
  <option value="toy">TOY</option>
</select>	
</div>
<div class="mb-3 ">
				<input class="btn btn-primary btn-lrg" type="submit" value="Save Changes">
</div><p> Created on <?php echo $date; ?> </p>
		</form>


		<div class="mb-3 ">
			
		<?php if($image != ''){
					ECHO '<img src="product_images/'.$image.'" class="img-thumbnail">';
			}else{
				ECHO '<img src="images/noimg.jpg" class="img-thumbnail">';
			}
			?>
			</div>


</div>
		<?php require_once 'includes/footer.php'; ?>
