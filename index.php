<?php 
  session_start();
  if (!isset($_SESSION['user_id']) && !isset($_SESSION['user_email'])) { 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login | Hydroponics</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
	  <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
	  	<form class="p-5 shadow-none" 
	  	      action="auth.php"
	  	      method="post" 
	  	      style="width: 30rem">
			<div class="d-flex justify-content-center">
				<div class="mx-auto">
					<img src="image/hydroponicslogo.jpeg" alt="Description of the image" width="100" height="100">
				</div>
			</div>
			<h5 class="text-center text-blue">NFT HYDROPONICS DECISION SUPPORT SYSTEM</h5>
	  		<h5 class="text-center">LOGIN</h5>
	  		<?php if (isset($_GET['error'])) { ?>
	  		<div class="alert alert-danger" role="alert">
			  <?=htmlspecialchars($_GET['error'])?>
			</div>
		    <?php } ?>

		  <div class="mb-3">
			<br>
			<br>
		    <input type="email" 
		           name="email" 
				   placeholder="Email"
		           value="<?php if(isset($_GET['email']))echo(htmlspecialchars($_GET['email'])) ?>" 
		           class="form-control" 
		           id="exampleInputEmail1" aria-describedby="emailHelp">
		  </div>
		  
		  <div class="mb-3">
		    <input type="password" 
		           class="form-control" 
		           name="password" 
				   placeholder="Password"
		           id="exampleInputPassword1">
		  </div>
		  <button type="submit" 
		          class="btn btn-primary">LOGIN
		  </button>
		</form>
	  </div>
<script>
document.addEventListener("DOMContentLoaded", function() {
  const textElement = document.querySelector(".text-blue");
  const text = "NFT HYDROPONICS SYSTEM";

  function typeText() {
    let index = 0;

    function updateText() {
      textElement.textContent = text.slice(0, index);
      index++;

      if (index <= text.length) {
        setTimeout(updateText, 100);
      } else {
        index = 0; 
        setTimeout(updateText, 1000);
      }
    }

    updateText();
  }

  typeText();
});
</script>

</body>
</html>
<?php 
}else {
   header("Location: ph.php");
}
 ?>
