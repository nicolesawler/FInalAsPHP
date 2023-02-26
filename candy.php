
<?php
session_start();
	// Include database connection code
require_once 'includes/db.php';


        // Fetch candy item from database
        $stmt = $db->prepare('SELECT * FROM candy');
        $stmt->execute();
        $stmt->bind_result($id, $name, $desc, $price, $quantity, $image, $date, $cat);
?>
<?php require_once 'includes/header.php'; ?>

<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron" style="background:url('images/banner3.jpg');background-size:cover;opacity:.6;">
  <div class="container">
	<h1 class="display-3">The Candy Plush Store!</h1>
  </div>
</div>



	<div class="container">

	<br><br>
		 <p>Categories:  &nbsp;&nbsp;
			<a href="candy.php">All</a> &nbsp;&nbsp; | &nbsp;&nbsp;
			<a href="category.php?cat=plush">Plush</a> &nbsp;&nbsp; | &nbsp;&nbsp;
			<a href="category.php?cat=candy">Candy</a> &nbsp;&nbsp; | &nbsp;&nbsp;
			<a href="category.php?cat=toy">Toy</a> 
</p><br><br>
       <!-- Example row of columns -->
	   <div class="row">
       <?php 
       $result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {  
    ?>
 
 <div class="col-md-4 fast items">
			<?php if($row["image"] != ''){
				ECHO '<img src="product_images/'.$row["image"].'" class="candy img-thumbnail"><br>';
			}else{
				ECHO '<img src="images/noimg.jpg" class="candy img-thumbnail"><br>';
			}
			?>
            <h2><?= $row["name"] ?></h2>
            <p>In Stock: <?= $row["quantity"] ?></p>
            <p><a class="btn btn-secondary" href="item.php?id=<?= $row["id"] ?>" role="button">View Item</a> 
			<a class="btn btn-primary" href="buy_now.php?id=<?= $row["id"] ?>&price=<?= $row["price"] ?>&order=<?= $row["name"] ?>" role="button">Buy Now</a></p>
          </div>


        <?php }?>
        </div>
	

		</div>


		<?php require_once 'includes/footer.php'; ?>
