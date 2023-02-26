<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

	// Include database connection code
	require_once 'includes/db.php';


    if(isset($_GET['order'])){
        $order = $_GET['order'];
        $price = $_GET['price'];
        $id = $_GET['id'];

            $stmt = $db->prepare('INSERT INTO orders (item, itemid, user, userid, price) VALUES (?,?,?,?,?)');
            $stmt->execute(array($order, $id, $_SESSION["username"], $_SESSION["user_id"], $price));
                if ($stmt) {
                    $last_id = $stmt->insert_id;
                    $alert = "You have successfully placed your order. Your order number is " . $last_id;
                } else {
                    $error =  "Error: " . mysqli_error($db);
                }


    }


?>
<?php require_once 'includes/header.php'; ?>
<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron" style="background:url('images/banner11.jpg');background-size:cover;opacity:.6;">
  <div class="container">
  <h1 class="display-3">Congratulations,  <?php echo $_SESSION["username"]; ?>!</h1>
  </div>
</div>



	<div class="container">

    <h1>You just purchased <?=  $order; ?></h1>

<?php if(isset($alert)): ?>
<div class="alert alert-primary" role="alert">
<p><?php echo $alert; ?></p>
</div>
<?php endif; ?>

<P>
    <a href="orders.php" class="btn btn-primary">View all orders</a>
</p>




    </div>

    <?php require_once 'includes/footer.php'; ?>
