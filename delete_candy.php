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
	require 'includes/db.php';


		// Get candy item ID from URL parameter
		if(isset($_GET['id'])){
			$id = $_GET['id'];
				// Fetch candy item from database
				$stmt = $db->prepare('SELECT * FROM candy WHERE id = ?');
				$stmt->execute(array($id));
				$stmt->bind_result($id, $name, $desc, $price, $quantity, $image, $date, $cat);
				$candy = $stmt->fetch();
		} else if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$id = $_POST['id'];
			$image = $_POST['image'];
			// Delete candy item in database

			//Delete photo
			$file_to_delete = 'product_images/'.$image;
			unlink($file_to_delete);

			//Delete DB Item
			$stmt = $db->prepare('DELETE FROM candy WHERE id = ?');
			$stmt->execute(array( $id));
			// Redirect back to candy page
			header('Location: index.php?alert=delete');
			exit();
		}else{
				// Redirect back to candy page
				header('Location: index.php');
				exit();
		}

?>

<?php require_once 'includes/header.php'; ?>

<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron" style="background:url('images/banner9.jpg') bottom center;background-size:cover;opacity:.6;">
  <div class="container">
  <h1 class="display-3">Hello, <?php echo $_SESSION["username"]; ?>!</h1>
	<p>You are currently deleting a  candy plush from the inventory list.</p>
	<p><a class="btn btn-primary btn-lg" href="index.php" role="button">Manage Stock &raquo;</a></p>
  </div>
</div>

	<div class="container">


		<h1>Delete Candy Plush </h1>
		<div class="alert alert-light" role="alert"><p>Are you sure you want to delete the following candy item?</p></div>

		<div class="card" style="width: 28rem;">
  

  <?php if($image != ''){
					ECHO '<img src="product_images/'.$image.'" class="card-img-top">';
			}else{
				ECHO '<img src="images/noimg.jpg" class="card-img-top">';
			}
			?>

  <div class="card-body">
    <h5 class="card-title"><?php echo $name; ?></h5>
    <p class="card-text"><?php echo $desc; ?></p>
    <p class="card-text">Price: <?php echo $price; ?></p>
    <p class="card-text">In Stock: <?php echo $quantity; ?></p>
    <p class="card-text">Category: <?php echo $cat; ?></p>
    

	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"">
		<input type="number" name="id" value="<?php echo $id; ?>" hidden>
		<input type="text" name="image" value="<?php echo $image; ?>" hidden>
			<input class="btn btn-primary" type="submit" value="Delete">
		</form>

  </div>
</div>
	

</div>
		<?php require_once 'includes/footer.php'; ?>
