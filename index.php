
<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}
// Check if user is admin
if (!isset($_SESSION["role"]) || $_SESSION["role"] != 'admin') {
    header("Location: candy.php");
    exit;
}

	// Include database connection code
	require_once 'includes/db.php';

// Get  parameter
if(isset($_GET['alert'])){
    $alert = $_GET['alert'];
    if($alert === 'delete'){
        $alert = "The item has been deleted.";
    }
}

        // Fetch candy item from database
        $stmt = $db->prepare('SELECT * FROM candy');
        $stmt->execute();
        $stmt->bind_result($id, $name, $desc, $price, $quantity, $image, $date, $cat);
$count = 0;
?>
<?php require_once 'includes/header.php'; ?>


<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron " style="background:url('images/banner7.jpg');background-size:cover;opacity:.6;">
  <div class="container">
	<h1 class="display-3">Hello, <?php echo $_SESSION["username"]; ?>!</h1>
  </div>
</div>



	<div class="container">

  
    <h1>Manage Store</h1>

    <?php if(isset($alert)): ?>
<div class="alert alert-primary" role="alert">
<p><?php echo $alert; ?></p>
</div>
<?php endif; ?>


    <a href="add_candy.php" class="btn btn-primary">Add New Candy Plush</a><br><br>
    <table class="table table-striped table-responsive">
        <tr>
            <th>Name</th>
            <th>Quantity</th>
            <th>Description</th>
            <th>Category</th>
            <th>Price</th>
            <th>Actions</th>
            <th></th>
        </tr>
        <?php $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {  $count ++; ?>
            <tr>
                <td><?= $row["name"] ?></td>
                <td><?= $row["quantity"] ?> in stock</td>
                <td><?= $row["description"] ?></td>
                <td><?= $row["category"] ?></td>
                <td>$<?= $row["price"] ?></td>
                <td><a class="btn btn-light" href="edit_candy.php?id=<?= $row["id"] ?>">Edit</a></td>
                <td><a class="btn btn-light" href="delete_candy.php?id=<?= $row["id"] ?>" onclick="return confirm('Are you sure you want to delete this candy?')">Delete</a></td>
            </tr>
        <?php 
        }

 ?>
    </table>
<?php echo $count . " Total Records"; ?>
        </div>
    <?php require_once 'includes/footer.php'; ?>
