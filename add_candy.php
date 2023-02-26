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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $cat = $_POST["cat"];
    $image = '';


        if (!file_exists($_FILES['image']['tmp_name']) || !is_uploaded_file($_FILES['image']['tmp_name'])) 
        {
            ////$error = 'No upload';
        }
        else
        {
            if (file_exists("product_images/". $_FILES['image']['name'])) {
                $error =  "The file ".$_FILES['image']['name']." exists";
            } else {
                $image = $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], "product_images/". $_FILES['image']['name']);
            }
        }


	$stmt = $db->prepare('INSERT INTO candy (name, description, price, quantity, image, category) VALUES (?,?,?,?,?,?)');
	$stmt->execute(array($name, $description, $price, $quantity, $image,$cat));
		if ($stmt) {
			$alert = "Candy Plush addition successful";
		} else {
			$error =  "Error: " . mysqli_error($db);
		}
}

?>
<?php require_once 'includes/header.php'; ?>
<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron" style="background:url('images/banner2.jpeg');background-size:cover;opacity:.6;">
  <div class="container">
  <h1 class="display-3">Hello, <?php echo $_SESSION["username"]; ?>!</h1>
	<p>You are currently adding a new candy plush to the inventory list.</p>
	<p><a class="btn btn-primary btn-lg" href="index.php" role="button">Manage Stock &raquo;</a></p>
  </div>
</div>



	<div class="container">

    <h1>Add New Candy Plush</h1>
    <p>* = required fields</p>

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



    <form runat="server" enctype="multipart/form-data" class="form" action="add_candy.php" method="POST">
    <div class="mb-3 ">
        <label class="form-label" for="Name">Name *</label>
        <input class="form-control" autofocus type="text" name="name" required>
        </div><div class="mb-3 ">
        <label class="form-label" for="Description">Description *</label>
        <textarea class="form-control"  name="description" required></textarea>
        </div><div class="mb-3 "> 
        <label class="form-label" for="Price">Price *</label>
        <input class="form-control" type="number" name="price" step="0.01" required>
        </div><div class="mb-3 "> 
        <label class="form-label" for="quantity">Quantity *</label>
        <input class="form-control" type="number" name="quantity" step="1" required>
        </div>
        <div class="mb-3 ">
			<label class="form-label" for="role">Category:</label>

<select class="form-control" name="cat" id="cat">
  <option selected value="plush">PLUSH</option>
  <option value="candy">CANDY</option>
  <option value="toy">TOY</option>
</select>	</div>
<div class="mb-3 "> 
        <label class="form-label" for="Price">Image (optional)</label>
        <input class="form-control" type="file" name="image" accept="image/*" onchange="loadFile(event)">
<img id="output"/>
<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
</script>
         </div><div class="mb-3 ">
        <input class="btn btn-primary" type="submit" value="Add Candy">
    </div>
    </form>

    </div>

    <?php require_once 'includes/footer.php'; ?>
