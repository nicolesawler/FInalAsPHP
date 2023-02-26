
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

// Retrieve candies from database
	// Fetch candy item from database
    $stmt = $db->prepare('SELECT * FROM orders WHERE userid = ?');
    $stmt->execute(array($_SESSION["user_id"]));
    $stmt->bind_result($id, $item, $itemid, $date, $user, $userid, $price);
    //$stmt->fetch();

$count = 0;
$amount = 0;
?>
<?php require_once 'includes/header.php'; ?>


<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron" style="background:url('images/banner11.jpg');background-size:cover;opacity:.6;">
  <div class="container">
  <h1 class="display-3">Here's your orders,  <?php echo $_SESSION["username"]; ?>!</h1>
  </div>
</div>
	<div class="container">

    <h1>My Orders</h1>

<table class="table table-striped">
        <tr>
            <th>Order #</th>
            <th>Item</th>
            <th>Bought By</th>
            <th>Price</th>
            <th>Date Ordered</th>
        </tr>
        <?php $result = $stmt->get_result();
while ($row = $result->fetch_assoc()) { $count ++; ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['item'] ?></td>
                <td><?= $row['user'] ?></td>
                <td>$<?= $row['price'] ?></td>
                <td><?= $row['dateordered'] ?></td>
            </tr>
        <?php 
          $amount = $amount + $row['price'];
}

 ?>
    </table>
<?php echo $count . " order for a total of $". $amount; ?>
        </div>
    <?php require_once 'includes/footer.php'; ?>
