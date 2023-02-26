<!DOCTYPE html>
<html>
<head>
    <title>Candy Store</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<link href="css/style.css" rel="stylesheet" >
<style>

</style>
<script
src="https://code.jquery.com/jquery-3.6.3.min.js"
integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
crossorigin="anonymous"></script>
<script type = "text/javascript" 
         src = "https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js">
      </script>
<script>
$( document ).ready(function() {
    //Fast show of items
  $( ".fast" ).first().show( "fast", function showNext() {
    $( this ).next( ".fast" ).show( "fast", showNext );
});

//fade in menu nav
$('div.hidden').fadeIn(1000).removeClass('hidden');

//Shake logo title
$("a.navbar-brand").click(function(){
               $(".navbar-brand").effect( "shake", {times:4}, 1000 );
            });
});
</script>

</head>
<body>
<header>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid hidden">
  <img class="rounded" src="images/logo.avif" alt="" width="42" height="42">
            <a class="navbar-brand" style="margin:0 15px;" href="#">Candy Plush Store</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
<div class="navbar-nav ">
<a class="nav-link" href="candy.php">Store</a> 
<?php if(isset($_SESSION['user_id'])): ?>
    <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){ ?>
        <a class="nav-link active" href="index.php">Admin (Inventory)</a>
        <a class="nav-link active" href="allorders.php">All Orders</a>
        <?php }else{ ?>
        <a class="nav-link active" href="orders.php">My Orders</a>
        <?php }?>
<a class="nav-link" href="logout.php">Logout</a>

<?php else: ?>
<a class="nav-link" href="login.php">Login</a>
<a class="nav-link" href="register.php">Register</a>
<?php endif; ?>
      </div>
    </div>
  </div>
</nav>

	</header>
    <div class="mobile">You are viewing this website from a mobile device.</div>

	<main role="main">