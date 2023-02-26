<?php
	session_start();

	// If user is not logged in, redirect to login page
	if (!isset($_SESSION['user_id'])) {
		header('Location: login.php');
		exit();
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

	}else{
			// Redirect back to candy page
			header('Location: index.php');
			exit();
	}
	
?>
<?php require_once 'includes/header.php'; ?>


<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron" style="background:url('images/banner8.png') top center;background-size:cover;opacity:.6;">
  <div class="container">
  <h1 class="display-3"><?php echo $name; ?></h1>
  </div>
</div>



	<div class="container">

    <h1>$<?php echo $price; ?> CAD</h1>

    <div class="mb-3 ">
        <img src="product_images/<?php echo $image; ?>" class="img-thumbnail" /><br>
	</div>

		<div class="mb-3 ">
            <b>Product ID:</b><br>
            SKU <?php echo $id; ?>
		
			</div><div class="mb-3 ">
				<label class="form-label" for="description">Description:</label>
			<p><?php echo $desc; ?></P>
			</div><div class="mb-3 ">
				<span class="badge text-bg-light">Quantity:</span>
			<?php echo $quantity; ?> in stock
			</div><div class="mb-3 ">
				<span class="badge text-bg-light">Category:</span>
			<?php echo $cat; ?> 
			</div><div class="mb-3 ">
            <a class="btn btn-primary" href="buy_now.php?id=<?= $id ?>&price=<?= $price ?>&order=<?= $name ?>" role="button">Buy Now</a>
			
</div><p> First launched on <?php echo $date; ?> </p>
		



</div>
		<?php require_once 'includes/footer.php'; ?>
